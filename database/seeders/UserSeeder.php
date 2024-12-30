<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'                => 1,
                'first_name'        => 'Vijay',
                'last_name'         => 'Pratap',
                'email'             => 'vijay@yopmail.com',
                'email_verified_at' => null,
                'password'          => bcrypt('Admin@123'), //i.e Admin@123
                'role'              => 1,
                'mobile'             => '9012456789',
                'job_title'         => 'CEO',
                'company'           => 'Owner',
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 2,
                'first_name'        => 'Will',
                'last_name'         => 'Jacks',
                'email'             => 'will@yopmail.com',
                'email_verified_at' => null,
                'password'          => bcrypt('Admin@123'), //i.e Admin@123
                'role'              => 2,
                'mobile'             => '9011456789',
                'job_title'         => 'Manager',
                'company'           => 'Employee',
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'id'                => 3,
                'first_name'        => 'Rahul',
                'last_name'         => 'Kumar',
                'email'             => 'rahul@yopmail.com',
                'email_verified_at' => null,
                'password'          => bcrypt('Admin@123'), //i.e Admin@123
                'role'              => 3,
                'mobile'             => '9013456789',
                'job_title'         => 'Customer',
                'company'           => 'Customer',
                'status'            => 1,
                'remember_token'    => null,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        User::insert($users);
    }
}
