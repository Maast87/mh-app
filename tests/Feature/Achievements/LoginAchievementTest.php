<?php

use App\Events\AchievementUnlocked;
use App\Models\User;
use App\Models\AchievementType;
use App\Models\Achievement;
use App\Models\AchievementProgress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    // Create login achievement type
    $this->type = AchievementType::factory()->create([
        'slug' => 'login',
        'name' => 'Login',
        'description' => 'Log in to your account',
    ]);

    // Create achievements with different tiers
    $this->bronzeAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'name' => 'Regular Visitor',
        'description' => 'Log in 3 times',
        'required_points' => 3,
        'tier_name' => 'Bronze',
        'icon_path' => 'images/mental-hygiene-achievement-loggedIn-level-1',
    ]);

    $this->silverAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'name' => 'Active Member',
        'description' => 'Log in 25 times',
        'required_points' => 25,
        'tier_name' => 'Silver',
        'icon_path' => 'images/mental-hygiene-achievement-loggedIn-level-2',
    ]);

    $this->goldAchievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'name' => 'Dedicated Member',
        'description' => 'Log in 100 times',
        'required_points' => 100,
        'tier_name' => 'Gold',
        'icon_path' => 'images/mental-hygiene-achievement-loggedIn-level-3',
    ]);
});

it('creates login achievement type on first login', function () {
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertDatabaseHas('achievement_types', [
        'slug' => 'login',
        'name' => 'Login',
    ]);
});

it('creates achievement progress on first login', function () {
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertDatabaseHas('achievement_progress', [
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 1,
    ]);
});

it('increments achievement progress on subsequent logins', function () {
    // First login
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // Logout
    $this->post('/logout');

    // Second login
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertDatabaseHas('achievement_progress', [
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 2,
    ]);
});

it('awards bronze achievement after three logins', function () {
    Event::fake([AchievementUnlocked::class]);

    // First login
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // No achievement yet
    Event::assertNotDispatched(AchievementUnlocked::class);
    expect($this->bronzeAchievement->isEarnedByUser($this->user))->toBeFalse();

    // Second login
    $this->post('/logout');
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // Still no achievement
    Event::assertNotDispatched(AchievementUnlocked::class);
    expect($this->bronzeAchievement->isEarnedByUser($this->user))->toBeFalse();

    // Third login
    $this->post('/logout');
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // Now we should have the bronze achievement
    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->bronzeAchievement->id;
    });
    expect($this->bronzeAchievement->isEarnedByUser($this->user))->toBeTrue();
});

it('awards silver achievement after twenty-five logins', function () {
    Event::fake([AchievementUnlocked::class]);

    // Create progress with 24 points
    AchievementProgress::create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 24,
        'last_action_at' => now(),
    ]);

    // Login to get the 25th point
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // Should have silver achievement now
    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->silverAchievement->id;
    });
    expect($this->silverAchievement->isEarnedByUser($this->user))->toBeTrue();
});

it('awards gold achievement after hundred logins', function () {
    Event::fake([AchievementUnlocked::class]);

    // Create progress with 99 points
    AchievementProgress::create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 99,
        'last_action_at' => now(),
    ]);

    // Login to get the 100th point
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    // Should have gold achievement now
    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->goldAchievement->id;
    });
    expect($this->goldAchievement->isEarnedByUser($this->user))->toBeTrue();
}); 