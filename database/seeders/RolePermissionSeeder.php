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
        // Vérifier si les tables Spatie existent
        if (!\Schema::hasTable('roles') || !\Schema::hasTable('permissions')) {
            $this->command->warn("⚠ Les tables Spatie Permission n'existent pas encore. Faites : php artisan migrate");
            return;
        }

        // ─────────────── Permissions ───────────────
        $permissions = [
            // Users
            'view users', 'create users', 'edit users', 'delete users',

            // Sponsors
            'view sponsors', 'create sponsors', 'edit sponsors', 'delete sponsors',

            // Partners
            'view partners', 'create partners', 'edit partners', 'delete partners',

            // Products
            'view products', 'create products', 'edit products', 'delete products',

            // Posts (Blog)
            'view posts', 'create posts', 'edit posts', 'delete posts',

            // Categories & Tags
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
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // ─────────────── Roles ───────────────
        $roles = [
            'admin' => $permissions, // l’admin a accès total

            'user' => [
                'view posts',
                'view products',
                'view faqs',
                'create tickets',
            ],

            'partner' => [
                'view products',
                'create products',
                'edit products',
                'delete products',
            ],

            'sponsor' => [
                'view ads',
                'create ads',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web'
            ]);

            $role->syncPermissions($rolePermissions);
        }

        // ─────────────── Admin par défaut ───────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@mybusiness.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password123'),
            ]
        );

        $admin->assignRole('admin');

        $this->command->info('🎉 Seeder RolePermission exécuté avec succès !');
    }
}
