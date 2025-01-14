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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('achievement_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('required_points');
            $table->string('tier_name');
            $table->string('icon_path')->nullable();
            $table->timestamps();

            // Ensure each tier name is unique per achievement type
            $table->unique(['achievement_type_id', 'tier_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
