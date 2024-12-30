<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name'               => 'Super Admin',
                'guard_name'         =>'admin',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'Admin',
                'guard_name'         =>'admin',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'User',
                'guard_name'         =>'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ];
        Role::insert($roles);
    }
}
