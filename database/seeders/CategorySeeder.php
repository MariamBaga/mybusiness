<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Digitalisation',
                'slug' => 'digitalisation',
                'color' => '#3B82F6',
                'description' => 'Articles sur la transformation digitale des PME',
                'order' => 1,
            ],
            [
                'name' => 'Gestion Commerciale',
                'slug' => 'gestion-commerciale',
                'color' => '#10B981',
                'description' => 'Conseils pour la gestion des ventes et stocks',
                'order' => 2,
            ],
            [
                'name' => 'Finance',
                'slug' => 'finance',
                'color' => '#F59E0B',
                'description' => 'Gestion financière et accès au crédit',
                'order' => 3,
            ],
            [
                'name' => 'Marketing',
                'slug' => 'marketing',
                'color' => '#EF4444',
                'description' => 'Stratégies marketing pour commerçants',
                'order' => 4,
            ],
            [
                'name' => 'Success Stories',
                'slug' => 'success-stories',
                'color' => '#8B5CF6',
                'description' => 'Témoignages et cas de réussite',
                'order' => 5,
            ],
            // Catégories produits
            [
                'name' => 'Équipements',
                'slug' => 'equipements',
                'color' => '#6366F1',
                'description' => 'Équipements pour commerces',
                'order' => 6,
            ],
            [
                'name' => 'Logiciels',
                'slug' => 'logiciels',
                'color' => '#EC4899',
                'description' => 'Solutions logicielles pour entreprises',
                'order' => 7,
            ],
            [
                'name' => 'Services',
                'slug' => 'services',
                'color' => '#14B8A6',
                'description' => 'Services aux entreprises',
                'order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ 8 catégories créées');
    }
}
