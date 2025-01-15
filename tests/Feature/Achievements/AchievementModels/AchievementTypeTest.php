<?php

use App\Models\AchievementType;
use App\Models\Achievement;

function createAchievementsForType(AchievementType $type): void
{
    // Create achievements with the same type but different tiers
    Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'tier_name' => 'Bronze'
    ]);
    Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'tier_name' => 'Silver'
    ]);
    Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'tier_name' => 'Gold'
    ]);
}

it('has a name attribute', function () {
    $type = AchievementType::factory()->create(['name' => 'Login']);

    expect($type->name)->toBe('Login');
});

it('has a description attribute', function () {
    $type = AchievementType::factory()->create(['description' => 'Achievements for logging in']);

    expect($type->description)->toBe('Achievements for logging in');
});

it('can have multiple achievements', function () {
    $type = AchievementType::factory()->create();
    createAchievementsForType($type);

    expect($type->achievements)->toHaveCount(3)
        ->each->toBeInstanceOf(Achievement::class);
});

it('deletes related achievements when deleted', function () {
    $type = AchievementType::factory()->create();
    createAchievementsForType($type);

    $achievementIds = $type->achievements->pluck('id');
    $type->delete();

    expect(Achievement::whereIn('id', $achievementIds)->count())->toBe(0);
});

it('can find a type by name', function () {
    $type = AchievementType::factory()->create(['name' => 'Login']);

    expect(AchievementType::findByName('Login')->id)->toBe($type->id);
}); 