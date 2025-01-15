<?php

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\User;
use App\Http\Resources\AchievementUnlockedResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    
    $type = AchievementType::factory()->create([
        'name' => 'Test Achievement Type',
        'slug' => 'test',
    ]);

    $this->achievement = Achievement::factory()->create([
        'achievement_type_id' => $type->id,
        'name' => 'Test Achievement',
        'description' => 'Test Description',
        'required_points' => 10,
        'tier_name' => 'Bronze',
        'icon_path' => 'test/path/icon.png',
    ]);
});

it('displays achievement notification when unlocked', function () {
    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->where('achievement_unlocked', null)
        );

    $this->achievement->users()->attach($this->user, [
        'earned_at' => now(),
    ]);

    session()->flash('achievement_unlocked', new AchievementUnlockedResource($this->achievement));

    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->where('achievement_unlocked.name', 'Test Achievement')
            ->where('achievement_unlocked.description', 'Test Description')
            ->where('achievement_unlocked.tier_name', 'Bronze')
            ->where('achievement_unlocked.icon_path', 'test/path/icon.png')
        );
});

it('does not show notification when no achievement unlocked', function () {
    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->where('achievement_unlocked', null)
        );
});

it('clears achievement notification after viewing', function () {
    $this->achievement->users()->attach($this->user, [
        'earned_at' => now(),
    ]);

    session()->flash('achievement_unlocked', new AchievementUnlockedResource($this->achievement));

    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->has('achievement_unlocked')
        );

    $this->refreshApplication();

    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->where('achievement_unlocked', null)
        );
});

it('includes required fields in achievement notification', function () {
    $this->achievement->users()->attach($this->user, [
        'earned_at' => now(),
    ]);

    session()->flash('achievement_unlocked', new AchievementUnlockedResource($this->achievement));

    $this->actingAs($this->user)
        ->get('/')
        ->assertInertia(fn ($page) => $page
            ->has('achievement_unlocked.name')
            ->has('achievement_unlocked.description')
            ->has('achievement_unlocked.tier_name')
            ->has('achievement_unlocked.icon_path')
        );
});

it('formats achievement data consistently across requests', function () {
    $this->achievement->users()->attach($this->user, [
        'earned_at' => now(),
    ]);

    session()->flash('achievement_unlocked', new AchievementUnlockedResource($this->achievement));
    $firstResponse = $this->actingAs($this->user)->get('/');
    
    session()->flash('achievement_unlocked', new AchievementUnlockedResource($this->achievement));
    $secondResponse = $this->actingAs($this->user)->get('/');

    $first = $firstResponse->original['page']['props']['achievement_unlocked'];
    $second = $secondResponse->original['page']['props']['achievement_unlocked'];

    // Compare only the relevant fields, ignoring timestamps
    expect($first['name'])->toBe($second['name']);
    expect($first['description'])->toBe($second['description']);
    expect($first['tier_name'])->toBe($second['tier_name']);
    expect($first['icon_path'])->toBe($second['icon_path']);
}); 