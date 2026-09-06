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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_id')->constrained('tracks')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('order')->default(1);
            $table->integer('xp_reward')->default(100);
            $table->integer('estimated_minutes')->default(10);
            $table->text('summary')->nullable();

            // Analogy & deep-dive explanation
            $table->string('analogy_title')->nullable();
            $table->longText('analogy_content')->nullable();

            // Library deep dive
            $table->string('library_name')->nullable();
            $table->longText('library_why')->nullable();
            $table->json('library_concepts')->nullable();
            $table->longText('code_example')->nullable();

            // Interactive Challenge / Quiz
            $table->text('challenge_question')->nullable();
            $table->json('challenge_options')->nullable();
            $table->integer('challenge_correct_index')->default(0);
            $table->text('challenge_explanation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
