<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop existing tables in the correct order to avoid foreign key constraint issues
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('progress');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('clients');
        
        // Create clients table first since projects references it
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes(); // Add soft deletes
            $table->timestamps();
        });

        // Create projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->string('status')->default('pending');
            $table->integer('progress')->default(0);
            $table->string('public_token')->unique()->nullable();
            $table->json('images')->nullable();
            $table->softDeletes(); // Add soft deletes
            $table->timestamps();
        });

        // Create progress table
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->date('date');
            $table->json('images')->nullable();
            $table->string('assigned_to')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->softDeletes(); // Add soft deletes
            $table->timestamps();
        });

        // Recreate personal access tokens table (needed for authentication)
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is not reversible as it's meant to reset the database
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('progress');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('clients');
    }
};