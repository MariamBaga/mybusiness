<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Général
            ['key' => 'site_name', 'value' => 'MyBusiness', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Solution digitale pour la gestion des commerçants et PME en Afrique', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'contact@mybusiness.com', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+221 78 123 45 67', 'type' => 'string', 'group' => 'general'],
            ['key' => 'site_address', 'value' => 'Dakar, Sénégal', 'type' => 'text', 'group' => 'general'],

            // Contact
            ['key' => 'contact_email', 'value' => 'support@mybusiness.com', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+221 78 123 45 67', 'type' => 'string', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '+221781234567', 'type' => 'string', 'group' => 'contact'],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/mybusiness', 'type' => 'string', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/mybusiness', 'type' => 'string', 'group' => 'social'],
            ['key' => 'linkedin_url', 'value' => 'https://linkedin.com/company/mybusiness', 'type' => 'string', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/mybusiness', 'type' => 'string', 'group' => 'social'],

            // SEO
            ['key' => 'meta_title', 'value' => 'MyBusiness - Gestion digitale pour PME Africaines', 'type' => 'string', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Solution complète de gestion pour commerçants, entrepreneurs et PME en Afrique', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'PME, digital, gestion, stocks, ventes, Afrique, entrepreneuriat', 'type' => 'text', 'group' => 'seo'],

            // Tarifs
            ['key' => 'free_trial_days', 'value' => '14', 'type' => 'number', 'group' => 'pricing'],
            ['key' => 'currency', 'value' => 'XOF', 'type' => 'string', 'group' => 'pricing'],
            ['key' => 'currency_symbol', 'value' => 'FCFA', 'type' => 'string', 'group' => 'pricing'],

            // Publicité
            ['key' => 'ad_price_per_day', 'value' => '5000', 'type' => 'number', 'group' => 'ads'],
            ['key' => 'ad_price_per_week', 'value' => '30000', 'type' => 'number', 'group' => 'ads'],
            ['key' => 'ad_price_per_month', 'value' => '100000', 'type' => 'number', 'group' => 'ads'],

            // API
            ['key' => 'api_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'api'],
            ['key' => 'api_rate_limit', 'value' => '60', 'type' => 'number', 'group' => 'api'],

            // Maintenance
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'maintenance'],

            // Newsletter
            ['key' => 'newsletter_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'newsletter'],

            // Analytics
            ['key' => 'google_analytics_id', 'value' => 'UA-XXXXX-Y', 'type' => 'string', 'group' => 'analytics'],
            ['key' => 'facebook_pixel_id', 'value' => 'XXXXXXXXXXXXXXX', 'type' => 'string', 'group' => 'analytics'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('✅ 30 paramètres créés');
    }
}
