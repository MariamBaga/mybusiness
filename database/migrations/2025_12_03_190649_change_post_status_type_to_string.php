<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Si on est sur MySQL/MariaDB ou PostgreSQL
        if (in_array(DB::getDriverName(), ['mysql', 'pgsql'])) {
            // Modifier la colonne "status" avec ALTER TABLE
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

        // Si on est sur SQLite
        elseif (DB::getDriverName() === 'sqlite') {
            // Créer une nouvelle colonne temporaire
            Schema::table('posts', function (Blueprint $table) {
                $table->string('status_temp', 20)->default('draft');
            });

            // Copier les données de l'ancienne colonne vers la nouvelle
            DB::statement("UPDATE posts SET status_temp = CASE
                WHEN status = '1' THEN 'published'
                WHEN status = '0' THEN 'draft'
                ELSE status
            END");

            // Supprimer l'ancienne colonne "status"
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('status');
            });

            // Renommer la colonne "status_temp" en "status"
            Schema::table('posts', function (Blueprint $table) {
                $table->renameColumn('status_temp', 'status');
            });
        }
    }

    public function down()
    {
        // Si on est sur MySQL/MariaDB ou PostgreSQL
        if (in_array(DB::getDriverName(), ['mysql', 'pgsql'])) {
            // Convertir pour rollback
            DB::statement("UPDATE posts SET status = CASE
                WHEN status = 'published' THEN '1'
                WHEN status = 'draft' THEN '0'
                ELSE status
            END");

            // Revenir au type initial de la colonne "status"
            DB::statement("ALTER TABLE posts MODIFY status TINYINT(1) NOT NULL DEFAULT 0");
        }

        // Si on est sur SQLite
        elseif (DB::getDriverName() === 'sqlite') {
            // Créer une nouvelle colonne temporaire
            Schema::table('posts', function (Blueprint $table) {
                $table->integer('status_temp')->default(0);
            });

            // Copier les données de l'ancienne colonne vers la nouvelle
            DB::statement("UPDATE posts SET status_temp = CASE
                WHEN status = 'published' THEN 1
                WHEN status = 'draft' THEN 0
                ELSE status
            END");

            // Supprimer l'ancienne colonne "status"
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('status');
            });

            // Renommer la colonne "status_temp" en "status"
            Schema::table('posts', function (Blueprint $table) {
                $table->renameColumn('status_temp', 'status');
            });
        }
    }
};
