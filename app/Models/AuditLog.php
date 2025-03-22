<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    protected $table = 'tbl_audit_log';
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'user_id',
        'action',
        'details'
    ];

    protected $casts = [
        'details' => 'array',
        'timestamp' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
