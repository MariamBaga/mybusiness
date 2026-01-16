<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            FaqSeeder::class,
            PartnerSeeder::class,
            SponsorSeeder::class,
            DocumentSeeder::class,
            SettingSeeder::class,
            ProductSeeder::class,
            AdvertisementSeeder::class,
        ]);
    }
}
