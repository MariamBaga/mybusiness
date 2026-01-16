<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        $sponsors = [
            [
                'name' => 'Microsoft Africa',
                'logo' => 'sponsors/microsoft.png',
                'url' => 'https://www.microsoft.com/africa',
                'description' => 'Partenaire technologique pour la digitalisation des entreprises africaines.',
                'level' => 'platinum',
                'status' => true,
                'order' => 1,
            ],
            [
                'name' => 'Google for Startups',
                'logo' => 'sponsors/google.png',
                'url' => 'https://startup.google.com',
                'description' => 'Programme d\'accompagnement des startups et PME innovantes.',
                'level' => 'gold',
                'status' => true,
                'order' => 2,
            ],
            [
                'name' => 'Ecobank Group',
                'logo' => 'sponsors/ecobank.png',
                'url' => 'https://www.ecobank.com',
                'description' => 'Groupe bancaire panafricain soutenant l\'entrepreneuriat.',
                'level' => 'gold',
                'status' => true,
                'order' => 3,
            ],
            [
                'name' => 'African Development Bank',
                'logo' => 'sponsors/afdb.png',
                'url' => 'https://www.afdb.org',
                'description' => 'Institution financière de développement en Afrique.',
                'level' => 'silver',
                'status' => true,
                'order' => 4,
            ],
            [
                'name' => 'Proparco',
                'logo' => 'sponsors/proparco.png',
                'url' => 'https://www.proparco.fr',
                'description' => 'Institution de financement du développement du secteur privé.',
                'level' => 'silver',
                'status' => true,
                'order' => 5,
            ],
            [
                'name' => 'COSEF',
                'logo' => 'sponsors/cosef.png',
                'url' => 'https://www.cosef.org',
                'description' => 'Conseil du patronat du Sénégal.',
                'level' => 'bronze',
                'status' => true,
                'order' => 6,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }

        $this->command->info('✅ 6 sponsors créés');
    }
}
