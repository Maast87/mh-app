<?php

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\User;
use App\Models\AchievementProgress;

it('has basic attributes', function () {
    $achievement = Achievement::factory()->create([
        'name' => 'First Login',
        'description' => 'Login for the first time',
        'required_points' => 1,
        'tier_name' => 'Bronze',
    ]);

    expect($achievement)
        ->name->toBe('First Login')
        ->description->toBe('Login for the first time')
        ->required_points->toBe(1)
        ->tier_name->toBe('Bronze')
        ->icon_path->toBeNull();
});

it('belongs to an achievement type', function () {
    $type = AchievementType::factory()->create();
    $achievement = Achievement::factory()->create([
        'achievement_type_id' => $type->id,
    ]);

    expect($achievement->type)
        ->toBeInstanceOf(AchievementType::class)
        ->id->toBe($type->id);
});

it('can be earned by users', function () {
    $achievement = Achievement::factory()->create();
    $user = User::factory()->create();

    // Initially not earned
    expect($achievement->isEarnedByUser($user))->toBeFalse();

    // Award the achievement
    $user->achievements()->attach($achievement->id, [
        'earned_at' => now(),
    ]);

    // Now it should be earned
    expect($achievement->isEarnedByUser($user))->toBeTrue();
});

it('can check if user has enough points to earn it', function () {
    $type = AchievementType::factory()->create();
    $achievement = Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'required_points' => 5,
    ]);
    $user = User::factory()->create();

    // Create progress with insufficient points
    AchievementProgress::factory()->create([
        'user_id' => $user->id,
        'achievement_type_id' => $type->id,
        'points' => 3,
    ]);

    expect($achievement->canBeEarnedByUser($user))->toBeFalse();

    // Update progress to have sufficient points
    AchievementProgress::query()
        ->where('user_id', $user->id)
        ->where('achievement_type_id', $type->id)
        ->update(['points' => 6]);

    expect($achievement->canBeEarnedByUser($user))->toBeTrue();
});

it('enforces unique tier names per achievement type', function () {
    $type = AchievementType::factory()->create();

    // First Bronze achievement should work
    Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'tier_name' => 'Bronze',
    ]);

    // Second Bronze achievement should fail
    expect(fn () => Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'tier_name' => 'Bronze',
    ]))->toThrow(Exception::class);
}); 