<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Enums\ExtensionName;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'extension_name',
        'contact_number',
        'email',
        'password',
        'role_id',
        'status',
        'profile_picture',
        'last_login'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login' => 'datetime',
            'extension_name' => ExtensionName::class,
        ];
    }

    /**
     * Relationship to Role model
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    /**
     * Password reset requests relationship
     */
    public function passwordResets()
    {
        return $this->hasMany(PasswordReset::class, 'user_id', 'user_id');
    }

    /**
     * Audit log entries relationship
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'user_id', 'user_id');
    }

    /**
     * Get the redirect path based on user role
     */
    public function getRedirectPath()
    {
        return match ($this->role->role_abbreviation) {
            'SA' => route('student.dashboard'),
            'AA' => route('admin.dashboard'),
            'PH' => route('program_head.dashboard'),
            'FF' => route('faculty.dashboard'),
            default => '/'
        };
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute()
    {
        $fullName = $this->first_name;

        if ($this->middle_name) {
            $fullName .= ' ' . strtoupper(substr($this->middle_name, 0, 1)) . '.';
        }

        $fullName .= ' ' . $this->last_name;

        if ($this->extension_name) {
            $fullName .= ', ' . $this->extension_name->value;
        }

        return $fullName;
    }
}
