<?php

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\AchievementProgress;
use App\Models\User;
use App\Http\Resources\AchievementUnlockedResource;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->type = AchievementType::factory()->create([
        'name' => 'Test Type',
        'description' => 'Test Description'
    ]);
    
    $this->achievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'name' => 'Test Achievement',
        'description' => 'Test Achievement Description',
        'required_points' => 10,
        'tier_name' => 'Bronze',
        'icon_path' => '/path/to/icon.svg'
    ]);
});

it('provides achievement data to the store through Inertia props', function () {
    session()->flash('achievement_unlocked', 
        new AchievementUnlockedResource($this->achievement));

    $response = $this->actingAs($this->user)
        ->get(route('home'));

    $response->assertInertia(fn (Assert $page) => $page
        ->where('achievement_unlocked.name', 'Test Achievement')
        ->where('achievement_unlocked.description', 'Test Achievement Description')
        ->where('achievement_unlocked.tier_name', 'Bronze')
        ->where('achievement_unlocked.icon_path', '/path/to/icon.svg')
    );
});

it('provides null achievement data when no achievement is unlocked', function () {
    $response = $this->actingAs($this->user)
        ->get(route('home'));

    $response->assertInertia(fn (Assert $page) => $page
        ->where('achievement_unlocked', null)
    );
});

it('provides achievement data in the correct format for the store', function () {
    $achievement = Achievement::factory()->create([
        'achievement_type_id' => $this->type->id,
        'name' => 'Format Test Achievement',
        'description' => 'Testing data format',
        'tier_name' => 'Gold',
    ]);

    session()->flash('achievement_unlocked', 
        new AchievementUnlockedResource($achievement));

    $response = $this->actingAs($this->user)
        ->get(route('home'));

    // Test that all required fields for the store are present
    $response->assertInertia(fn (Assert $page) => $page
        ->has('achievement_unlocked', fn (Assert $achievement) => $achievement
            ->hasAll([
                'name',
                'description',
                'tier_name',
                'icon_path',
                'earned_at'
            ])
            ->whereType('name', 'string')
            ->whereType('description', 'string')
            ->whereType('tier_name', 'string')
            ->whereType('earned_at', 'string')
        )
    );
});

it('maintains achievement data through Inertia visits', function () {
    session()->flash('achievement_unlocked', 
        new AchievementUnlockedResource($this->achievement));

    // First visit should have achievement data
    $this->actingAs($this->user)
        ->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page
            ->has('achievement_unlocked')
        );

    // Start new session to simulate Inertia navigation
    $this->refreshApplication();

    // Next visit should not have achievement data (flash cleared)
    $this->actingAs($this->user)
        ->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page
            ->where('achievement_unlocked', null)
        );
});

it('provides achievement data immediately when unlocked', function () {
    // Create achievement progress with enough points
    AchievementProgress::create([
        'user_id' => $this->user->id,
        'achievement_type_id' => $this->type->id,
        'points' => 20,
        'last_action_at' => now(),
    ]);
    
    // Simulate unlocking achievement through service
    $response = $this->actingAs($this->user)
        ->post(route('achievements.award'), [
            'achievement_id' => $this->achievement->id
        ]);

    // The award response should contain the achievement data
    $response->assertSessionHas('achievement_unlocked');

    // Check that the achievement data is available on next page load
    $this->actingAs($this->user)
        ->get(route('home'))
        ->assertInertia(fn (Assert $page) => $page
            ->where('achievement_unlocked.name', 'Test Achievement')
            ->where('achievement_unlocked.tier_name', 'Bronze')
        );
}); 