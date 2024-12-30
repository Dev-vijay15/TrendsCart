<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard read
            [
                'name'               => 'read dashboard',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // Dashboard read end

            // Role start
            [
                'name'               => 'read roles management ',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'read roles',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create roles',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit roles',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update roles',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete roles',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // Role end

            // Permission start

            [
                'name'               => 'read permissions management ',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'read permissions',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create permissions',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit permissions',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update permissions',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete permissions',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // Permission end

            // Admin user

            [
                'name'               => 'read user management ',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],

            [
                'name'               => 'read users',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create users',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit users',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update users',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete users',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // Admin user end

            // products start
            [
                'name'               => 'read products management',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'read products',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create products',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit products',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update products',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete products',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // products end

            //categories management
            [
                'name'               => 'read categories management',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            //category
            [
                'name'               => 'read categories',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create categories',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit categories',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update categories',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete categories',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // Category end

            //start brands
            [
                'name'               => 'read brands management',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'read brands',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'create brands',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'edit brands',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'update brands',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'name'               => 'delete brands',
                'guard_name'         => 'web',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            // brands end

        ];

        Permission::insert($permissions);
    }
}
