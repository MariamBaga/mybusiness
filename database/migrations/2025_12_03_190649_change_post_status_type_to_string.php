<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Méthode sécurisée pour MySQL/MariaDB
        DB::statement("ALTER TABLE posts MODIFY status VARCHAR(20) NOT NULL DEFAULT 'draft'");

        // Convertir les valeurs existantes
        DB::statement("UPDATE posts SET status = CASE
            WHEN status = '1' THEN 'published'
            WHEN status = '0' THEN 'draft'
            ELSE status
        END");

        // Mettre à jour les valeurs null si nécessaire
        DB::statement("UPDATE posts SET status = 'draft' WHERE status IS NULL");
    }

    public function down()
    {
        // Convertir pour rollback
        DB::statement("UPDATE posts SET status = CASE
            WHEN status = 'published' THEN '1'
            WHEN status = 'draft' THEN '0'
            ELSE status
        END");

        DB::statement("ALTER TABLE posts MODIFY status TINYINT(1) NOT NULL DEFAULT 0");
    }
};
