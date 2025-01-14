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
        Schema::create('achievement_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('achievement_type_id')->constrained()->onDelete('cascade');
            $table->integer('points')->default(0);
            $table->timestamp('last_action_at')->nullable();
            $table->timestamps();

            // Each user can only have one progress record per achievement type
            $table->unique(['user_id', 'achievement_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievement_progress');
    }
};
