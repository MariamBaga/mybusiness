<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Partner;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $partners = Partner::all();
        $categories = Category::all();

        if ($partners->isEmpty()) {
            $this->command->warn('⚠ Aucun partenaire trouvé. Exécutez d\'abord PartnerSeeder.');
            return;
        }

        $products = [
            [
                'name' => 'Caisse Enregistreuse Intelligente',
                'slug' => Str::slug('Caisse Enregistreuse Intelligente'),
                'image' => 'products/caisse-intelligente.jpg',
                'price' => 450000,
                'old_price' => 550000,
                'stock' => 25,
                'sku' => 'PROD-001',
                'short_description' => 'Caisse enregistreuse connectée avec impression de ticket et gestion de stock intégrée.',
                'description' => 'Caisse enregistreuse intelligente avec écran tactile 7 pouces...',
                'specifications' => json_encode([
                    'Écran' => '7 pouces tactile',
                    'Connectivité' => 'Wi-Fi, 4G, Bluetooth',
                    'Batterie' => '12h d\'autonomie',
                    'Imprimante' => 'Thermique intégrée',
                ]),
                'partner_product_url' => 'https://techsolutions.sn/produits/caisse-intelligente',
                'partner_contact_email' => 'ventes@techsolutions.sn',
                'redirect_to_partner' => true,
                'is_featured' => true,
            ],
            // ... autres produits
        ];

        foreach ($products as $index => $productData) {
            Product::create(array_merge($productData, [
                'partner_id' => $partners[$index % $partners->count()]->id,
                'category_id' => $categories->count() > 0 ? $categories[0]->id : null,
            ]));
        }

        $this->command->info('✅ Produits marketplace créés');
    }
}
