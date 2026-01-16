<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Général
            [
                'question' => 'Qu\'est-ce que MyBusiness ?',
                'answer' => 'MyBusiness est une solution digitale conçue pour aider les commerçants, entrepreneurs et PME à gérer efficacement leurs activités : ventes, stocks, clients et rapports.',
                'category' => 'Général',
                'order' => 1,
            ],
            [
                'question' => 'Comment puis-je créer un compte ?',
                'answer' => 'Cliquez sur "S\'inscrire" en haut à droite, remplissez le formulaire avec vos informations et validez votre email. Votre compte sera activé immédiatement.',
                'category' => 'Général',
                'order' => 2,
            ],
            [
                'question' => 'MyBusiness est-il gratuit ?',
                'answer' => 'Nous proposons une période d\'essai gratuite de 14 jours. Ensuite, vous pouvez choisir parmi nos différents forfaits : Basic, Pro, Premium ou Enterprise.',
                'category' => 'Tarifs',
                'order' => 1,
            ],
            [
                'question' => 'Quelles sont les méthodes de paiement acceptées ?',
                'answer' => 'Nous acceptons les cartes Visa, Mastercard, les virements bancaires et les paiements mobiles (Orange Money, Wave, etc.).',
                'category' => 'Tarifs',
                'order' => 2,
            ],
            // Fonctionnalités
            [
                'question' => 'Comment fonctionne la gestion des stocks ?',
                'answer' => 'Notre système permet de suivre en temps réel vos inventaires, de recevoir des alertes de stock bas et de générer automatiquement des commandes de réapprovisionnement.',
                'category' => 'Fonctionnalités',
                'order' => 1,
            ],
            [
                'question' => 'Puis-je suivre mes ventes sur mobile ?',
                'answer' => 'Oui, MyBusiness est accessible sur ordinateur, tablette et smartphone. Vous pouvez suivre vos performances commerciales où que vous soyez.',
                'category' => 'Fonctionnalités',
                'order' => 2,
            ],
            [
                'question' => 'Comment fonctionnent les rapports automatiques ?',
                'answer' => 'Le système génère quotidiennement, hebdomadairement et mensuellement des rapports détaillés sur vos ventes, vos meilleurs produits et vos performances par canal.',
                'category' => 'Fonctionnalités',
                'order' => 3,
            ],
            // Support
            [
                'question' => 'Comment contacter le support ?',
                'answer' => 'Vous pouvez utiliser le formulaire de contact, ouvrir un ticket dans votre espace client ou nous contacter via WhatsApp au +221 78 123 45 67.',
                'category' => 'Support',
                'order' => 1,
            ],
            [
                'question' => 'Quels sont les horaires du support ?',
                'answer' => 'Notre support est disponible du lundi au vendredi de 8h à 18h et le samedi de 9h à 13h (heure GMT).',
                'category' => 'Support',
                'order' => 2,
            ],
            // Marketplace
            [
                'question' => 'Comment devenir partenaire sur la marketplace ?',
                'answer' => 'Rendez-vous sur la page "Devenir Partenaire", remplissez le formulaire et notre équipe vous contactera dans les 48h pour valider votre inscription.',
                'category' => 'Marketplace',
                'order' => 1,
            ],
            [
                'question' => 'Comment acheter des produits sur la marketplace ?',
                'answer' => 'Parcourez le catalogue, ajoutez les produits à votre panier et suivez le processus de commande. Vous serez redirigé vers le partenaire pour finaliser l\'achat.',
                'category' => 'Marketplace',
                'order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        $this->command->info('✅ 12 FAQs créées');
    }
}
