<?php

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\AchievementProgress;
use App\Models\AchievementType;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->type = AchievementType::factory()->create(['name' => 'Login']);
    
    // Create achievements with different tiers
    $this->bronzeAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'required_points' => 3,
        'tier_name' => 'Bronze',
    ]);
    
    $this->silverAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'required_points' => 25,
        'tier_name' => 'Silver',
    ]);
    
    $this->goldAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'required_points' => 100,
        'tier_name' => 'Gold',
    ]);
});

it('awards achievement when user has enough points', function () {
    Event::fake();

    // Create progress with enough points for bronze
    AchievementProgress::factory()->create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 5,
    ]);

    // Try to award the achievement
    $response = $this->actingAs($this->user)
        ->post(route('achievements.award'), [
            'achievement_id' => $this->bronzeAchievement->id,
        ]);

    $response->assertRedirect()
        ->assertSessionHas('success');

    // Check if achievement was awarded
    expect($this->bronzeAchievement->isEarnedByUser($this->user))->toBeTrue();

    // Check if event was dispatched
    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->user->id === $this->user->id
            && $event->achievement->id === $this->bronzeAchievement->id;
    });
});

it('does not award achievement when user lacks points', function () {
    Event::fake();

    // Create progress with insufficient points
    AchievementProgress::factory()->create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 1,
    ]);

    // Try to award the achievement
    $response = $this->actingAs($this->user)
        ->post(route('achievements.award'), [
            'achievement_id' => $this->bronzeAchievement->id,
        ]);

    $response->assertRedirect()
        ->assertSessionHas('error');

    // Check achievement was not awarded
    expect($this->bronzeAchievement->isEarnedByUser($this->user))->toBeFalse();

    // Check no event was dispatched
    Event::assertNotDispatched(AchievementUnlocked::class);
});

it('does not award already earned achievements', function () {
    Event::fake();

    // Create progress and award achievement
    AchievementProgress::factory()->create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 5,
    ]);

    $this->user->achievements()->attach($this->bronzeAchievement->id, [
        'earned_at' => now(),
    ]);

    // Try to award the achievement again
    $response = $this->actingAs($this->user)
        ->post(route('achievements.award'), [
            'achievement_id' => $this->bronzeAchievement->id,
        ]);

    $response->assertRedirect()
        ->assertSessionHas('error');

    // Check no event was dispatched
    Event::assertNotDispatched(AchievementUnlocked::class);
});

it('requires authentication', function () {
    $response = $this->post(route('achievements.award'), [
        'achievement_id' => $this->bronzeAchievement->id,
    ]);

    $response->assertRedirect(route('login'));
});

it('validates achievement existence', function () {
    $response = $this->actingAs($this->user)
        ->post(route('achievements.award'), [
            'achievement_id' => 9999,
        ]);

    $response->assertRedirect()
        ->assertSessionHas('error');
}); 