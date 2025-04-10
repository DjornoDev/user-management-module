<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Services\AuditLogService;
use App\Models\AuditLog;
use App\Enums\ExtensionName;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function dashboard()
    {
        // Role counts for stats cards
        $admissionHeadCount = User::whereHas('role', fn($q) => $q->where('role_abbreviation', 'AA'))->count();
        $programHeadCount = User::whereHas('role', fn($q) => $q->where('role_abbreviation', 'PH'))->count();
        $facultyFacilitatorCount = User::whereHas('role', fn($q) => $q->where('role_abbreviation', 'FF'))->count();
        $studentApplicantCount = User::whereHas('role', fn($q) => $q->where('role_abbreviation', 'SA'))->count();

        // Calculate total users for progress bars
        $totalUsers = $admissionHeadCount + $programHeadCount +
            $facultyFacilitatorCount + $studentApplicantCount;

        // Calculate percentages
        $admissionHeadPercentage = $totalUsers > 0 ? ($admissionHeadCount / $totalUsers) * 100 : 0;
        $programHeadPercentage = $totalUsers > 0 ? ($programHeadCount / $totalUsers) * 100 : 0;
        $facultyPercentage = $totalUsers > 0 ? ($facultyFacilitatorCount / $totalUsers) * 100 : 0;
        $studentPercentage = $totalUsers > 0 ? ($studentApplicantCount / $totalUsers) * 100 : 0;

        // Filter counts
        $activeCount = User::where('status', 'active')->count();
        $inactiveCount = User::where('status', 'inactive')->count();
        $adminCount = $admissionHeadCount; // AA is Admin
        $facultyCount = $facultyFacilitatorCount;

        // Get recent audit logs for the dashboard
        $recentAuditLogs = AuditLog::with('user')
            ->latest('timestamp')
            ->take(5)
            ->get();

        return view('admission_admin.dashboard', compact(
            'admissionHeadCount',
            'programHeadCount',
            'facultyFacilitatorCount',
            'studentApplicantCount',
            'activeCount',
            'inactiveCount',
            'adminCount',
            'facultyCount',
            'recentAuditLogs',
            'admissionHeadPercentage',
            'programHeadPercentage',
            'facultyPercentage',
            'studentPercentage'
        ));
    }

    public function getUsersData(Request $request)
    {
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 5);
        $searchTerm = $request->input('search', '');
        $sortColumn = $request->input('sortColumn', 'name');
        $sortDirection = $request->input('sortDirection', 'asc');
        $statusFilter = $request->input('statusFilter');
        $roleFilter = $request->input('roleFilter');

        $query = User::with(['role']);

        // Search
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('first_name', 'like', "%$searchTerm%")
                    ->orWhere('last_name', 'like', "%$searchTerm%")
                    ->orWhere('email', 'like', "%$searchTerm%")
                    ->orWhere('contact_number', 'like', "%$searchTerm%")
                    ->orWhereHas('role', fn($q) => $q->where('role_name', 'like', "%$searchTerm%"));
            });
        }

        // Filters
        if ($statusFilter) $query->where('status', $statusFilter);
        if ($roleFilter) $query->whereHas('role', fn($q) => $q->where('role_abbreviation', $roleFilter));

        // Sorting
        switch ($sortColumn) {
            case 'role':
                $query->join('tbl_roles', 'tbl_users.role_id', '=', 'tbl_roles.role_id')
                    ->orderBy('tbl_roles.role_name', $sortDirection);
                break;
            case 'name':
                $query->orderBy('first_name', $sortDirection)
                    ->orderBy('last_name', $sortDirection);
                break;
            default:
                $query->orderBy($sortColumn, $sortDirection);
        }

        // Pagination
        $total = $query->count();
        $users = $query->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();

        $data = $users->map(function ($user) {
            return [
                'name' => $user->full_name,
                'email' => $user->email,
                'role' => $user->role->role_name,
                'phone' => $user->contact_number ?? 'N/A',
                'status' => $user->status,
                'action' => view('partials.user_actions', ['user' => $user])->render()
            ];
        });

        return response()->json([
            'users' => $data,
            'total' => $total,
            'currentPage' => $page,
            'pageSize' => $pageSize
        ]);
    }

    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        return response()->json([
            'valid' => Hash::check($request->password, auth()->user()->password)
        ]);
    }

    public function edit(User $user)
    {
        return view('admission_admin.users.edit', [
            'user' => $user->load('role'),
            'roles' => Role::all(),
            'statusOptions' => ['Active', 'Inactive']
        ]);
    }

    public function show(User $user)
    {
        return view('admission_admin.users.show', [
            'user' => $user->load('role')
        ]);
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'extension_name' => ['nullable', 'string', 'in:' . implode(',', ExtensionName::values())],
            'email' => 'required|email|unique:tbl_users,email,' . $user->user_id . ',user_id',
            'contact_number' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
            'role_id' => 'required|exists:tbl_roles,role_id',
        ]);

        // Capture old values for the audit log
        $oldValues = $user->toArray();
        $oldValues = array_map(function ($value) {
            return $value instanceof \Carbon\Carbon
                ? $value->format('Y-m-d')
                : $value;
        }, $oldValues);
        $oldValues = array_intersect_key($oldValues, $validatedData);

        // Get old role name
        $oldRoleName = $user->role->role_name;
        $oldStatus = $user->status;

        // Update the user with validated data
        $user->update($validatedData);

        // Get new role name if it changed
        $newRoleName = Role::find($validatedData['role_id'])->role_name;

        // Log the update action
        AuditLogService::log(
            'User Updated',
            [
                'user_name' => $user->full_name,
                'user_email' => $user->email,
                'old_values' => $oldValues,
                'new_values' => $validatedData,
                'updated_by' => auth()->user()->full_name,
            ]
        );

        // Log specific important changes separately
        if ($oldRoleName != $newRoleName) {
            AuditLogService::log(
                'Role Changed',
                [
                    'user_name' => $user->full_name,
                    'old_role' => $oldRoleName,
                    'new_role' => $newRoleName,
                    'updated_by' => auth()->user()->full_name,
                ]
            );
        }

        if ($oldStatus != $validatedData['status']) {
            $action = $validatedData['status'] === 'active'
                ? 'User Activated'
                : 'User Deactivated';
            AuditLogService::log(
                $action,
                [
                    'user_name' => $user->full_name,
                    'old_status' => $oldStatus,
                    'new_status' => $validatedData['status'],
                    'updated_by' => auth()->user()->full_name,
                ]
            );
        }

        // Redirect to the users dashboard with a success message
        return redirect()->route('users.show', $user);
    }

    public function create()
    {
        return view('admission_admin.users.create', [
            'roles' => Role::all(),
            'statusOptions' => ['Active', 'Inactive']
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'extension_name' => ['nullable', 'string', 'in:' . implode(',', ExtensionName::values())],
            'email' => 'required|email|unique:tbl_users,email',
            'contact_number' => 'nullable|string|max:20',
            'status' => 'required|in:active,inactive',
            'role_id' => 'required|exists:tbl_roles,role_id',
        ]);

        // Create user with random password
        $user = User::create(array_merge($validatedData, [
            'password' => Hash::make(Str::random(40))
        ]));

        // Send password reset notification
        $status = Password::sendResetLink(
            ['email' => $user->email]
        );

        if ($status !== Password::RESET_LINK_SENT) {
            return back()->withErrors(['email' => __($status)]);
        }

        // Get role name for the audit log
        $roleName = Role::find($validatedData['role_id'])->role_name;

        // Log the user creation
        AuditLogService::log(
            'User Created',
            [
                'user_name' => $user->full_name,
                'user_email' => $user->email,
                'role' => $roleName,
                'status' => $user->status,
                'created_by' => auth()->user()->full_name,
            ]
        );

        // Redirect to the user's show page with a success message
        return redirect()->route('users.show', $user)
            ->with('success', 'User created successfully!');
    }

    // Function to Delete a User
    public function destroy(User $user)
    {

        // Store user info before deletion for audit log
        $userName = $user->full_name;
        $userEmail = $user->email;
        $userRole = $user->role->role_name;

        $user->delete();

        // Log the deletion
        AuditLogService::log(
            'User Deleted',
            [
                'user_name' => $userName,
                'user_email' => $userEmail,
                'role' => $userRole,
                'deleted_by' => auth()->user()->full_name,
            ]
        );

        return redirect()->route('admin.dashboard')
            ->with('success', 'User deleted successfully');
    }

    // New method to show audit logs
    public function auditLogs(Request $request)
    {
        $query = AuditLog::with('user')
            ->latest('timestamp');

        // Apply filters if provided
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('timestamp', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('timestamp', '<=', $request->date_to);
        }

        $auditLogs = $query->paginate(15);
        $users = User::orderBy('first_name')->get();
        $actions = AuditLog::select('action')->distinct()->pluck('action');

        return view('admission_admin.audit_logs.index', compact('auditLogs', 'users', 'actions'));
    }
}
