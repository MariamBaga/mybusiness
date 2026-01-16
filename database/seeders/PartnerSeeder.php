<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'TechSolutions SARL',
                'email' => 'contact@techsolutions.sn',
                'phone' => '+221338699999',
                'website' => 'https://techsolutions.sn',
                'logo' => 'partners/techsolutions.png',
                'description' => 'Fournisseur de solutions technologiques pour PME africaines.',
                'address' => 'Point E, Dakar, Sénégal',
                'type' => 'corporate',
                'status' => true,
                'featured' => true,
            ],
            [
                'name' => 'Express Logistics',
                'email' => 'info@expresslogistics.sn',
                'phone' => '+221338237777',
                'website' => 'https://expresslogistics.sn',
                'logo' => 'partners/express-logistics.png',
                'description' => 'Service de livraison et logistique pour commerçants.',
                'address' => 'Sicap Liberté, Dakar, Sénégal',
                'type' => 'corporate',
                'status' => true,
                'featured' => true,
            ],
            [
                'name' => 'Orange Senegal',
                'email' => 'partenariat@orange.sn',
                'phone' => '+221338699999',
                'website' => 'https://orange.sn',
                'logo' => 'partners/orange.png',
                'description' => 'Opérateur télécoms et services digitaux.',
                'address' => 'Immeuble Orange, Route de l\'Aéroport, Dakar',
                'type' => 'corporate',
                'status' => true,
                'featured' => true,
            ],
            [
                'name' => 'Banque Régionale de Marchés',
                'email' => 'partenariats@brm.sn',
                'phone' => '+221338237777',
                'website' => 'https://www.brm.sn',
                'logo' => 'partners/brm.png',
                'description' => 'Institution financière spécialisée dans le financement des PME.',
                'address' => 'Rue Léon Gontran Damas, Dakar',
                'type' => 'corporate',
                'status' => true,
                'featured' => false,
            ],
            [
                'name' => 'Agence de Promotion des Investissements',
                'email' => 'contact@apix.sn',
                'phone' => '+221338399939',
                'website' => 'https://www.apix.sn',
                'logo' => 'partners/apix.png',
                'description' => 'Agence gouvernementale d\'appui aux investisseurs.',
                'address' => 'Immeuble APIX, Dakar',
                'type' => 'government',
                'status' => true,
                'featured' => false,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }

        $this->command->info('✅ 5 partenaires créés dans la table `partners`');
    }
}
