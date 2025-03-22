<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Services\AuditLogService;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        // Get validated data and remove profile_picture before filling
        $validated = $request->validated();
        $allowedFields = [
            'first_name',
            'last_name',
            'middle_name',
            'extension_name',
            'email',
            'contact_number',
            'address',
            'date_of_birth',
            'sex',
            'civil_status',
            'citizenship',
            'place_of_birth',
            'blood_type',
            'religion',
            'birth_order',
            'no_of_siblings'
        ];
        unset($validated['profile_picture']);

        // Update other fields
        $user->fill($validated);

        // Check if email was changed
        $emailChanged = $user->isDirty('email');
        if ($emailChanged) {
            $user->email_verified_at = null;
        }

        // Capture changed fields before saving
        $changedFields = array_keys($user->getDirty());

        $user->save();

        // Log profile update
        if (!empty($changedFields)) {
            AuditLogService::log(
                'Profile Updated',
                [
                    'user_name' => $user->full_name,
                    'changed_fields' => $changedFields,
                    'email_verification_reset' => $emailChanged,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Store user info before deletion for audit log
        $userName = $user->full_name;
        $userEmail = $user->email;

        // Log account self-deletion
        AuditLogService::log(
            'Account Self-Deleted',
            [
                'user_name' => $userName,
                'user_email' => $userEmail,
            ],
            $user->user_id
        );

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
