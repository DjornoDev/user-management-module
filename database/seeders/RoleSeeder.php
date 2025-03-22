<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'Student Applicant', 'role_abbreviation' => 'SA'],
            ['role_name' => 'Admission Admin', 'role_abbreviation' => 'AA'], // Merged Admission Head & Staff
            ['role_name' => 'Program Head', 'role_abbreviation' => 'PH'], // Renamed Department Chairperson
            ['role_name' => 'Faculty Facilitator', 'role_abbreviation' => 'FF'], // Merged Interviewer & Test Proctor
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
