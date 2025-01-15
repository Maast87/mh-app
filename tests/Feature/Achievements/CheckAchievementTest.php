<?php

use App\Events\AchievementUnlocked;
use App\Models\User;
use App\Models\AchievementType;
use App\Models\Achievement;
use App\Models\Check;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    // Create check achievement type
    $this->type = AchievementType::factory()->create([
        'slug' => 'check',
        'name' => 'Check',
        'description' => 'Complete mental health check assessments',
    ]);

    // Create achievements with different tiers
    $this->achievements = [
        'level1' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Beginner Checker',
            'description' => 'Complete your first check',
            'required_points' => 1,
            'tier_name' => 'Level 1',
            'icon_path' => 'images/mental-hygiene-achievement-checksFilled-level-1.png',
        ]),
        'level2' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Regular Checker',
            'description' => 'Complete 5 checks',
            'required_points' => 5,
            'tier_name' => 'Level 2',
            'icon_path' => 'images/mental-hygiene-achievement-checksFilled-level-2.png',
        ]),
        'level3' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Dedicated Checker',
            'description' => 'Complete 15 checks',
            'required_points' => 15,
            'tier_name' => 'Level 3',
            'icon_path' => 'images/mental-hygiene-achievement-checksFilled-level-3.png',
        ]),
        'level4' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Expert Checker',
            'description' => 'Complete 50 checks',
            'required_points' => 50,
            'tier_name' => 'Level 4',
            'icon_path' => 'images/mental-hygiene-achievement-checksFilled-level-4.png',
        ]),
        'level5' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Master Checker',
            'description' => 'Complete 100 checks',
            'required_points' => 100,
            'tier_name' => 'Level 5',
            'icon_path' => 'images/mental-hygiene-achievement-checksFilled-level-5.png',
        ]),
    ];

    // Create a check for testing
    $this->check = Check::create(['name' => 'Test Check']);
});

it('awards level 1 achievement after first check', function () {
    Event::fake([AchievementUnlocked::class]);

    // Complete first check
    $this->actingAs($this->user)
        ->post('/me-learning', [
            'score' => 10,
            'check_id' => $this->check->id,
        ]);

    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->achievements['level1']->id;
    });

    expect($this->achievements['level1']->isEarnedByUser($this->user))->toBeTrue();
});

it('awards level 2 achievement after 5 checks', function () {
    Event::fake([AchievementUnlocked::class]);

    // Complete 5 checks
    for ($i = 0; $i < 5; $i++) {
        $this->actingAs($this->user)
            ->post('/me-learning', [
                'score' => 10,
                'check_id' => $this->check->id,
            ]);
    }

    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->achievements['level2']->id;
    });

    expect($this->achievements['level2']->isEarnedByUser($this->user))->toBeTrue();
});

it('awards level 3 achievement after 15 checks', function () {
    Event::fake([AchievementUnlocked::class]);

    // Complete 15 checks
    for ($i = 0; $i < 15; $i++) {
        $this->actingAs($this->user)
            ->post('/me-learning', [
                'score' => 10,
                'check_id' => $this->check->id,
            ]);
    }

    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->achievements['level3']->id;
    });

    expect($this->achievements['level3']->isEarnedByUser($this->user))->toBeTrue();
});

it('awards level 4 achievement after 50 checks', function () {
    Event::fake([AchievementUnlocked::class]);

    // Complete 50 checks
    for ($i = 0; $i < 50; $i++) {
        $this->actingAs($this->user)
            ->post('/me-learning', [
                'score' => 10,
                'check_id' => $this->check->id,
            ]);
    }

    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->achievements['level4']->id;
    });

    expect($this->achievements['level4']->isEarnedByUser($this->user))->toBeTrue();
});

it('awards level 5 achievement after 100 checks', function () {
    Event::fake([AchievementUnlocked::class]);

    // Complete 100 checks
    for ($i = 0; $i < 100; $i++) {
        $this->actingAs($this->user)
            ->post('/me-learning', [
                'score' => 10,
                'check_id' => $this->check->id,
            ]);
    }

    Event::assertDispatched(AchievementUnlocked::class, function ($event) {
        return $event->achievement->id === $this->achievements['level5']->id;
    });

    expect($this->achievements['level5']->isEarnedByUser($this->user))->toBeTrue();
});

it('requires authentication to store check scores', function () {
    $response = $this->post('/me-learning', [
        'score' => 10,
        'check_id' => $this->check->id,
    ]);

    $response->assertRedirect('/login');
});

it('validates check score input', function () {
    $response = $this->actingAs($this->user)
        ->post('/me-learning', [
            'score' => 'invalid',
            'check_id' => 'invalid',
        ]);

    $response->assertSessionHasErrors(['score', 'check_id']);
});

it('increments achievement progress on each check completion', function () {
    $this->actingAs($this->user)
        ->post('/me-learning', [
            'score' => 10,
            'check_id' => $this->check->id,
        ]);

    $progress = $this->user->getProgressForType($this->type);
    expect($progress->points)->toBe(1);

    $this->actingAs($this->user)
        ->post('/me-learning', [
            'score' => 10,
            'check_id' => $this->check->id,
        ]);

    $progress->refresh();
    expect($progress->points)->toBe(2);
}); 