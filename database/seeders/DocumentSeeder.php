<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'title' => 'Business Plan MyBusiness 2024',
                'slug' => 'business-plan-mybusiness-2024',
                'file' => 'documents/business-plan.pdf',
                'file_size' => 2450000, // 2.45 MB
                'file_type' => 'pdf',
                'type' => 'pdf',
                'description' => 'Plan d\'affaires complet de la solution MyBusiness avec projections financières et stratégie de développement.',
                'download_count' => 142,
                'status' => true,
            ],
            [
                'title' => 'Brochure Commerciale MyBusiness',
                'slug' => 'brochure-commerciale-mybusiness',
                'file' => 'documents/brochure.pdf',
                'file_size' => 1250000, // 1.25 MB
                'file_type' => 'pdf',
                'type' => 'pdf',
                'description' => 'Présentation détaillée des fonctionnalités, tarifs et avantages de la solution MyBusiness.',
                'download_count' => 356,
                'status' => true,
            ],
            [
                'title' => 'Fiche Technique - Module Ventes',
                'slug' => 'fiche-technique-module-ventes',
                'file' => 'documents/fiche-ventes.pdf',
                'file_size' => 850000, // 850 KB
                'file_type' => 'pdf',
                'type' => 'pdf',
                'description' => 'Documentation technique détaillée sur le module de gestion des ventes.',
                'download_count' => 89,
                'status' => true,
            ],
            [
                'title' => 'Fiche Technique - Module Stocks',
                'slug' => 'fiche-technique-module-stocks',
                'file' => 'documents/fiche-stocks.pdf',
                'file_size' => 920000, // 920 KB
                'file_type' => 'pdf',
                'type' => 'pdf',
                'description' => 'Documentation technique détaillée sur le module de gestion des stocks.',
                'download_count' => 76,
                'status' => true,
            ],
            [
                'title' => 'Guide d\'Implémentation',
                'slug' => 'guide-implementation',
                'file' => 'documents/guide-implementation.pdf',
                'file_size' => 3100000, // 3.1 MB
                'file_type' => 'pdf',
                'type' => 'pdf',
                'description' => 'Guide étape par étape pour implémenter MyBusiness dans votre entreprise.',
                'download_count' => 231,
                'status' => true,
            ],
            [
                'title' => 'Modèle de Rapport Mensuel',
                'slug' => 'modele-rapport-mensuel',
                'file' => 'documents/modele-rapport.xlsx',
                'file_size' => 450000, // 450 KB
                'file_type' => 'excel',
                'type' => 'excel',
                'description' => 'Modèle Excel personnalisable pour vos rapports de performance.',
                'download_count' => 167,
                'status' => true,
            ],
            [
                'title' => 'Présentation Investisseurs',
                'slug' => 'presentation-investisseurs',
                'file' => 'documents/presentation-investisseurs.pptx',
                'file_size' => 5200000, // 5.2 MB
                'file_type' => 'ppt',
                'type' => 'other',
                'description' => 'Présentation complète pour les investisseurs et partenaires institutionnels.',
                'download_count' => 54,
                'status' => true,
            ],
        ];

        foreach ($documents as $document) {
            Document::create($document);
        }

        $this->command->info('✅ 7 documents créés');
    }
}
