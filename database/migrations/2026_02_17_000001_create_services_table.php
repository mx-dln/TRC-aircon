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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('icon')->nullable()->comment('Icon name or path');
            $table->string('color')->default('blue')->comment('Color class: blue, green, purple, yellow, red, indigo');
            $table->enum('video_type', ['youtube', 'vimeo', 'file'])->nullable()->comment('Type of video source');
            $table->text('video_url')->nullable()->comment('YouTube or Vimeo URL');
            $table->string('video_file')->nullable()->comment('Path to uploaded video file');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
