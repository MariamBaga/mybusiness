<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);
        $sponsorRole = Role::firstOrCreate(['name' => 'sponsor', 'guard_name' => 'web']);

        // 1. Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@mybusiness.com'],
            [
                'name' => 'Admin MyBusiness',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 2. Commerçants normaux (rôle 'user')
        $users = [
            ['name' => 'Alioune Ndiaye', 'email' => 'alioune@example.com'],
            ['name' => 'Mariama Diallo', 'email' => 'mariama@example.com'],
            ['name' => 'Test User', 'email' => 'test@example.com'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole($userRole);
        }

        // 3. Comptes partenaires (pour gérer les produits marketplace)
        $partners = [
            ['name' => 'Fatou Diop', 'email' => 'fatou@techsolutions.com'],
            ['name' => 'Abdoulaye Sy', 'email' => 'abdoulaye@logistics.com'],
        ];

        foreach ($partners as $partnerData) {
            $partner = User::firstOrCreate(
                ['email' => $partnerData['email']],
                [
                    'name' => $partnerData['name'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]
            );
            $partner->assignRole($partnerRole);
        }

        // 4. Sponsor
        $sponsor = User::firstOrCreate(
            ['email' => 'mohamed@banque-afrique.com'],
            [
                'name' => 'Mohamed Sow',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $sponsor->assignRole($sponsorRole);

        $this->command->info('✅ Utilisateurs créés : 1 admin, 3 membres, 2 partenaires, 1 sponsor');
    }
}
