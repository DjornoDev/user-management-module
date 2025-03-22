<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    /**
     * Log an action performed by a user
     *
     * @param string $action The action performed
     * @param array $details Additional details about the action
     * @param int|null $userId The ID of the user who performed the action (defaults to authenticated user)
     * @return AuditLog
     */
    public static function log(string $action, array $details = [], ?int $userId = null): AuditLog
    {
        // Use provided user ID or get from authenticated user
        $userId = $userId ?? Auth::id();

        // Create and return the audit log entry
        return AuditLog::create([
            'user_id' => $userId,
            'action' => $action,
            'details' => $details,
            // timestamp is automatically set by the database
        ]);
    }
}
