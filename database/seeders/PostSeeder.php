<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@mybusiness.com')->first();
        $categories = Category::all();
        $tags = Tag::all();

        $posts = [
            [
                'title' => 'Comment digitaliser votre commerce en 5 étapes simples',
                'slug' => Str::slug('Comment digitaliser votre commerce en 5 étapes simples'),
                'excerpt' => 'Découvrez comment transformer votre commerce traditionnel en entreprise digitale performante.',
                'content' => $this->generateContent('Digitalisation commerce'),
                'image' => 'posts/digitalisation-commerce.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'category_id' => $categories->where('slug', 'digitalisation')->first()->id,
            ],
            [
                'title' => 'Gestion optimale des stocks : Les meilleures pratiques',
                'slug' => Str::slug('Gestion optimale des stocks : Les meilleures pratiques'),
                'excerpt' => 'Évitez les ruptures de stock et optimisez votre inventaire avec ces méthodes éprouvées.',
                'content' => $this->generateContent('Gestion stocks'),
                'image' => 'posts/gestion-stocks.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(15),
                'category_id' => $categories->where('slug', 'gestion-commerciale')->first()->id,
            ],
            [
                'title' => 'Comment MyBusiness a aidé une PME à doubler son chiffre d\'affaires',
                'slug' => Str::slug('Comment MyBusiness a aidé une PME à doubler son chiffre d\'affaires'),
                'excerpt' => 'Témoignage d\'un commerçant qui a transformé son entreprise grâce à notre solution.',
                'content' => $this->generateContent('Success story'),
                'image' => 'posts/success-story.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(20),
                'category_id' => $categories->where('slug', 'success-stories')->first()->id,
            ],
            [
                'title' => 'Les outils essentiels pour le suivi des ventes en temps réel',
                'slug' => Str::slug('Les outils essentiels pour le suivi des ventes en temps réel'),
                'excerpt' => 'Découvrez comment suivre vos performances commerciales instantanément.',
                'content' => $this->generateContent('Suivi ventes'),
                'image' => 'posts/suivi-ventes.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'category_id' => $categories->where('slug', 'gestion-commerciale')->first()->id,
            ],
            [
                'title' => 'Financement des PME : Les solutions disponibles en Afrique',
                'slug' => Str::slug('Financement des PME : Les solutions disponibles en Afrique'),
                'excerpt' => 'Tour d\'horizon des options de financement pour développer votre entreprise.',
                'content' => $this->generateContent('Financement PME'),
                'image' => 'posts/financement-pme.jpg',
                'status' => 'published',
                'published_at' => now()->subDays(8),
                'category_id' => $categories->where('slug', 'finance')->first()->id,
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create(array_merge($postData, [
                'author_id' => $admin->id,
                'meta_title' => $postData['title'],
                'meta_description' => $postData['excerpt'],
                'meta_keywords' => 'PME, digital, entreprise, gestion',
                'views' => rand(100, 500),
            ]));

            // Attacher des tags aléatoires
            $post->tags()->attach(
                $tags->random(rand(2, 4))->pluck('id')->toArray()
            );
        }

        $this->command->info('✅ 5 articles de blog créés');
    }

    private function generateContent($topic): string
    {
        return "<h2>Introduction</h2>
                <p>Dans le monde des affaires d'aujourd'hui, la {$topic} est devenue essentielle pour la croissance des entreprises.</p>

                <h2>Les avantages clés</h2>
                <ul>
                    <li>Augmentation de l'efficacité opérationnelle</li>
                    <li>Meilleure prise de décision</li>
                    <li>Réduction des coûts</li>
                    <li>Amélioration de la satisfaction client</li>
                </ul>

                <h2>Comment commencer ?</h2>
                <p>Pour bien démarrer avec {$topic}, suivez ces étapes simples :</p>
                <ol>
                    <li>Évaluez vos besoins actuels</li>
                    <li>Définissez vos objectifs</li>
                    <li>Choisissez les bons outils</li>
                    <li>Formez votre équipe</li>
                    <li>Mesurez vos résultats</li>
                </ol>

                <h2>Conclusion</h2>
                <p>La {$topic} n'est pas une option mais une nécessité pour les entreprises qui veulent prospérer dans l'économie moderne.</p>";
    }
}
