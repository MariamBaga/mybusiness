<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ────────── Permissions ──────────
        $permissions = [
            // Users
            'view users', 'create users', 'edit users', 'delete users',

            // Sponsors
            'view sponsors', 'create sponsors', 'edit sponsors', 'delete sponsors',

            // Partners
            'view partners', 'create partners', 'edit partners', 'delete partners',

            // Products
            'view products', 'create products', 'edit products', 'delete products',

            // Posts / Blog
            'view posts', 'create posts', 'edit posts', 'delete posts',
            'view categories', 'create categories', 'edit categories', 'delete categories',
            'view tags', 'create tags', 'edit tags', 'delete tags',

            // FAQ
            'view faqs', 'create faqs', 'edit faqs', 'delete faqs',

            // Tickets
'view tickets', 'create tickets', 'edit tickets', 'delete tickets',


            // Advertisements
            'view ads', 'create ads', 'edit ads', 'delete ads',

            // Documents
            'view documents', 'create documents', 'edit documents', 'delete documents',

            // Settings
            'view settings', 'edit settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ────────── Roles ──────────
        $roles = [
            'admin' => $permissions, // Admin a toutes les permissions
            'user' => [
                'view posts',
                'view products',
                'view faqs',
                'create tickets',
            ],
            'partner' => [
                'view posts', 'view products', 'create products',
            ],
            'sponsor' => [
                'view posts', 'create ads',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // ────────── Utilisateur admin par défaut ──────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@mybusiness.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password123'), // change ensuite en production
            ]
        );

        $admin->assignRole('admin');

        $this->command->info('Seeder RolePermission exécuté avec succès !');
    }
}
