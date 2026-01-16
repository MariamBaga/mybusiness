<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        $ads = [
            [
                'title' => 'Formation Gestion Commerciale',
                'image' => 'ads/formation-gestion.jpg',
                'url' => '/formations/gestion-commerciale',
                'placement' => 'header',
                'type' => 'banner',
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(30),
                'views' => 1245,
                'clicks' => 89,
                'priority' => 10,
                'status' => true,
                'target' => 'members',
                'advertiser_name' => 'MyBusiness Academy',
                'price_paid' => null,
                'payment_status' => 'paid',
                'payment_method' => 'subscription',
            ],
            [
                'title' => 'Équipements Pro à -20%',
                'image' => 'ads/promotion-equipements.jpg',
                'url' => '/marketplace?promo=20',
                'placement' => 'sidebar',
                'type' => 'banner',
                'start_date' => now(),
                'end_date' => now()->addDays(15),
                'views' => 876,
                'clicks' => 45,
                'priority' => 8,
                'status' => true,
                'target' => 'members',
                'advertiser_name' => 'TechSolutions',
                'price_paid' => null,
                'payment_status' => 'paid',
                'payment_method' => 'subscription',
            ],
            [
                'title' => 'Financement PME - Taux Préférentiel',
                'image' => 'ads/financement-pme.jpg',
                'url' => '#',
                'placement' => 'popup',
                'type' => 'banner',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(7),
                'views' => 2341,
                'clicks' => 156,
                'priority' => 15,
                'status' => true,
                'target' => 'public',
                'advertiser_name' => 'Banque Africaine',
                'price_paid' => 50000,
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'transaction_id' => 'TXN-' . rand(10000, 99999),
            ],
            [
                'title' => 'Formation Certification Digital',
                'image' => 'ads/formation-digital.jpg',
                'url' => '#',
                'placement' => 'sidebar',
                'type' => 'banner',
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(20),
                'views' => 1543,
                'clicks' => 98,
                'priority' => 7,
                'status' => true,
                'target' => 'public',
                'advertiser_name' => 'Centre de Formation Pro',
                'price_paid' => 30000,
                'payment_status' => 'paid',
                'payment_method' => 'mobile_money',
                'transaction_id' => 'TXN-' . rand(10000, 99999),
            ],
            [
                'title' => 'Nouveau : Service Livraison 24h',
                'image' => 'ads/livraison-24h.jpg',
                'url' => '#',
                'placement' => 'footer',
                'type' => 'banner',
                'start_date' => now(),
                'end_date' => now()->addDays(45),
                'views' => 987,
                'clicks' => 67,
                'priority' => 5,
                'status' => true,
                'target' => 'public',
                'advertiser_name' => 'Express Logistics',
                'price_paid' => 75000,
                'payment_status' => 'paid',
                'payment_method' => 'bank_transfer',
                'transaction_id' => 'TXN-' . rand(10000, 99999),
            ],
        ];

        foreach ($ads as $ad) {
            Advertisement::create($ad);
        }

        $this->command->info('✅ 5 publicités créées');
    }
}
