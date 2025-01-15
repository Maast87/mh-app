<?php

use App\Models\AchievementProgress;
use App\Models\AchievementType;
use App\Models\User;

it('has basic attributes', function () {
    $progress = AchievementProgress::factory()->create([
        'points' => 5,
        'last_action_at' => now(),
    ]);

    expect($progress)
        ->points->toBe(5)
        ->last_action_at->toBeInstanceOf(Carbon\Carbon::class);
});

it('belongs to a user', function () {
    $user = User::factory()->create();
    $progress = AchievementProgress::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($progress->user)
        ->toBeInstanceOf(User::class)
        ->id->toBe($user->id);
});

it('belongs to an achievement type', function () {
    $type = AchievementType::factory()->create();
    $progress = AchievementProgress::factory()->create([
        'achievement_type_id' => $type->id,
    ]);

    expect($progress->achievementType)
        ->toBeInstanceOf(AchievementType::class)
        ->id->toBe($type->id);
});

it('can be created through user relationship', function () {
    $user = User::factory()->create();
    $type = AchievementType::factory()->create();

    $progress = $user->getProgressForType($type);

    expect($progress)
        ->toBeInstanceOf(AchievementProgress::class)
        ->user_id->toBe($user->id)
        ->achievement_type_id->toBe($type->id)
        ->points->toBe(0);
});

it('creates progress record only once per user and type', function () {
    $user = User::factory()->create();
    $type = AchievementType::factory()->create();

    // First call should create new record
    $progress1 = $user->getProgressForType($type);
    
    // Second call should return the same record
    $progress2 = $user->getProgressForType($type);

    expect($progress1->id)->toBe($progress2->id)
        ->and(AchievementProgress::count())->toBe(1);
});

it('maintains last action timestamp', function () {
    $progress = AchievementProgress::factory()->create([
        'last_action_at' => now()->subDay(),
    ]);

    $oldTimestamp = $progress->last_action_at;

    // Update points
    $progress->update([
        'points' => 10,
        'last_action_at' => now(),
    ]);

    expect($progress->last_action_at)->toBeGreaterThan($oldTimestamp);
}); 