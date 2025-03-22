<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'tbl_roles';
    protected $primaryKey = 'role_id';

    protected $fillable = ['role_name', 'role_abbreviation'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
