<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Admission Admin
            [
                'first_name' => 'John Michael',
                'last_name' => 'Smith',
                'middle_name' => 'Anderson',
                'extension_name' => 'Jr.',
                'email' => 'john.smith@example.com',
                'password' => Hash::make('Pass@1234'),
                'role_id' => Role::where('role_name', 'Admission Admin')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 234-567-8901',
                'date_of_birth' => '1985-06-15',
                'age' => 39,
                'place_of_birth' => 'New York, USA',
                'sex' => 'Male',
                'civil_status' => 'Married',
                'address' => '123 Main Street, NY',
                'citizenship' => 'American',
                'blood_type' => 'O+',
                'religion' => 'Christian',
                'birth_order' => 1,
                'no_of_siblings' => 2,
            ],
            [
                'first_name' => 'Sophia Anne',
                'last_name' => 'Johnson',
                'middle_name' => 'Marie',
                'extension_name' => null,
                'email' => 'sophia.johnson@example.com',
                'password' => Hash::make('Admin@2024'),
                'role_id' => Role::where('role_name', 'Admission Admin')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 345-678-9012',
                'date_of_birth' => '1990-09-25',
                'age' => 34,
                'place_of_birth' => 'Los Angeles, USA',
                'sex' => 'Female',
                'civil_status' => 'Single',
                'address' => '456 Elm Street, LA',
                'citizenship' => 'American',
                'blood_type' => 'A+',
                'religion' => 'Catholic',
                'birth_order' => 2,
                'no_of_siblings' => 3,
            ],
            // Student Applicant
            [
                'first_name' => 'David',
                'last_name' => 'Brown',
                'middle_name' => 'Lee',
                'extension_name' => null,
                'email' => 'david.brown@example.com',
                'password' => Hash::make('Student@123'),
                'role_id' => Role::where('role_name', 'Student Applicant')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 456-789-0123',
                'date_of_birth' => '2002-05-10',
                'age' => 22,
                'place_of_birth' => 'Chicago, USA',
                'sex' => 'Male',
                'civil_status' => 'Single',
                'address' => '789 Oak Avenue, IL',
                'citizenship' => 'American',
                'blood_type' => 'B+',
                'religion' => 'Protestant',
                'birth_order' => 1,
                'no_of_siblings' => 1,
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Davis',
                'middle_name' => 'Rose',
                'extension_name' => null,
                'email' => 'emily.davis@example.com',
                'password' => Hash::make('Student@456'),
                'role_id' => Role::where('role_name', 'Student Applicant')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 567-890-1234',
                'date_of_birth' => '2001-12-30',
                'age' => 23,
                'place_of_birth' => 'Houston, USA',
                'sex' => 'Female',
                'civil_status' => 'Single',
                'address' => '234 Maple Road, TX',
                'citizenship' => 'American',
                'blood_type' => 'AB-',
                'religion' => 'Jewish',
                'birth_order' => 3,
                'no_of_siblings' => 4,
            ],
            // Program Head
            [
                'first_name' => 'Robert',
                'last_name' => 'Miller',
                'middle_name' => 'James',
                'extension_name' => null,
                'email' => 'robert.miller@example.com',
                'password' => Hash::make('Head@1234'),
                'role_id' => Role::where('role_name', 'Program Head')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 678-901-2345',
                'date_of_birth' => '1982-03-18',
                'age' => 42,
                'place_of_birth' => 'San Francisco, USA',
                'sex' => 'Male',
                'civil_status' => 'Married',
                'address' => '567 Cedar Lane, CA',
                'citizenship' => 'American',
                'blood_type' => 'O-',
                'religion' => 'Atheist',
                'birth_order' => 1,
                'no_of_siblings' => 1,
            ],
            [
                'first_name' => 'Olivia',
                'last_name' => 'Wilson',
                'middle_name' => 'Claire',
                'extension_name' => null,
                'email' => 'olivia.wilson@example.com',
                'password' => Hash::make('Head@5678'),
                'role_id' => Role::where('role_name', 'Program Head')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 789-012-3456',
                'date_of_birth' => '1988-11-22',
                'age' => 36,
                'place_of_birth' => 'Seattle, USA',
                'sex' => 'Female',
                'civil_status' => 'Divorced',
                'address' => '890 Birch Drive, WA',
                'citizenship' => 'American',
                'blood_type' => 'A-',
                'religion' => 'Buddhist',
                'birth_order' => 2,
                'no_of_siblings' => 2,
            ],
            [
                'first_name' => 'Benjamin',
                'last_name' => 'Harris',
                'middle_name' => 'Joseph',
                'extension_name' => null,
                'email' => 'benjamin.harris@example.com',
                'password' => Hash::make('Faculty@123'),
                'role_id' => Role::where('role_name', 'Faculty Facilitator')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 890-123-4567',
                'date_of_birth' => '1980-07-14',
                'age' => 44,
                'place_of_birth' => 'Denver, USA',
                'sex' => 'Male',
                'civil_status' => 'Married',
                'address' => '345 Pine Street, CO',
                'citizenship' => 'American',
                'blood_type' => 'B+',
                'religion' => 'Christian',
                'birth_order' => 2,
                'no_of_siblings' => 3,
            ],
            [
                'first_name' => 'Charlotte',
                'last_name' => 'Martinez',
                'middle_name' => 'Evelyn',
                'extension_name' => null,
                'email' => 'charlotte.martinez@example.com',
                'password' => Hash::make('Faculty@456'),
                'role_id' => Role::where('role_name', 'Faculty Facilitator')->first()->role_id,
                'status' => 'Active',
                'contact_number' => '+1 901-234-5678',
                'date_of_birth' => '1985-04-28',
                'age' => 39,
                'place_of_birth' => 'Phoenix, USA',
                'sex' => 'Female',
                'civil_status' => 'Single',
                'address' => '678 Willow Lane, AZ',
                'citizenship' => 'American',
                'blood_type' => 'O+',
                'religion' => 'Catholic',
                'birth_order' => 1,
                'no_of_siblings' => 2,
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
