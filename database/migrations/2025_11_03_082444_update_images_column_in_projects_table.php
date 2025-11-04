<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure the column exists and is text type
        if (Schema::hasColumn('projects', 'images')) {
            Schema::table('projects', function (Blueprint $table) {
                // Convert existing text to JSON
                $table->json('images_temp')->nullable();
            });

            // Copy data from old column to new column
            \DB::statement("UPDATE projects SET images_temp = IF(images IS NULL, NULL, JSON_ARRAY(images))");

            // Drop the old column and rename the new one
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('images');
                $table->renameColumn('images_temp', 'images');
            });
        } else {
            // If column doesn't exist, create it as JSON
            Schema::table('projects', function (Blueprint $table) {
                $table->json('images')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert back to text if needed
        if (Schema::hasColumn('projects', 'images')) {
            Schema::table('projects', function (Blueprint $table) {
                // Create a temporary text column
                $table->text('images_temp')->nullable();
            });

            // Copy data from JSON to text (take first element if it's an array)
            \DB::statement("UPDATE projects SET images_temp = JSON_UNQUOTE(JSON_EXTRACT(images, '$[0]'))");

            // Drop the JSON column and rename the text one
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('images');
                $table->renameColumn('images_temp', 'images');
            });
        }
    }
};
