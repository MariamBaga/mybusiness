<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'PME', 'slug' => 'pme', 'color' => '#3B82F6'],
            ['name' => 'Digital', 'slug' => 'digital', 'color' => '#10B981'],
            ['name' => 'Stocks', 'slug' => 'stocks', 'color' => '#F59E0B'],
            ['name' => 'Ventes', 'slug' => 'ventes', 'color' => '#EF4444'],
            ['name' => 'Afrique', 'slug' => 'afrique', 'color' => '#8B5CF6'],
            ['name' => 'Entrepreneuriat', 'slug' => 'entrepreneuriat', 'color' => '#EC4899'],
            ['name' => 'Financement', 'slug' => 'financement', 'color' => '#14B8A6'],
            ['name' => 'Innovation', 'slug' => 'innovation', 'color' => '#F97316'],
            ['name' => 'Sénégal', 'slug' => 'senegal', 'color' => '#84CC16'],
            ['name' => 'Formation', 'slug' => 'formation', 'color' => '#06B6D4'],
            ['name' => 'SaaS', 'slug' => 'saas', 'color' => '#8B5CF6'],
            ['name' => 'Mobile', 'slug' => 'mobile', 'color' => '#EF4444'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        $this->command->info('✅ 12 tags créés');
    }
}
