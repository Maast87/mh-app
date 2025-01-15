<?php

use App\Models\Achievement;
use App\Models\AchievementType;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->type = AchievementType::factory()->create([
        'name' => 'Test Type',
        'description' => 'Test Description'
    ]);
    
    // Create achievements with different tiers
    $this->achievements = [
        'bronze' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Bronze Achievement',
            'description' => 'Bronze Description',
            'required_points' => 10,
            'tier_name' => 'Bronze'
        ]),
        'silver' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Silver Achievement',
            'description' => 'Silver Description',
            'required_points' => 50,
            'tier_name' => 'Silver'
        ]),
        'gold' => Achievement::factory()->create([
            'achievement_type_id' => $this->type->id,
            'name' => 'Gold Achievement',
            'description' => 'Gold Description',
            'required_points' => 100,
            'tier_name' => 'Gold'
        ])
    ];
});

it('displays achievements page for authenticated user', function () {
    $response = $this->actingAs($this->user)
        ->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));

    $response->assertStatus(200);
    $response->assertInertia(fn (Assert $page) => $page
        ->component('Profiel/ProfielResultatenAchievements')
        ->has('achievementTypes')
        ->has('requestedUser')
    );
});

it('shows correct achievement data structure', function () {
    $response = $this->actingAs($this->user)
        ->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Profiel/ProfielResultatenAchievements')
        ->has('achievementTypes.0', fn (Assert $type) => $type
            ->has('id')
            ->has('name')
            ->has('description')
            ->has('progress', fn (Assert $progress) => $progress
                ->has('points')
                ->has('last_action_at')
            )
            ->has('achievements', 3)
            ->has('achievements.0', fn (Assert $achievement) => $achievement
                ->has('id')
                ->has('name')
                ->has('description')
                ->has('required_points')
                ->has('tier_name')
                ->has('icon_path')
                ->has('is_earned')
                ->has('can_be_earned')
                ->has('earned_at')
            )
        )
    );
});

it('requires authentication', function () {
    $response = $this->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));
    
    $response->assertRedirect(route('login'));
});

it('shows earned achievements', function () {
    // Award an achievement
    $this->user->achievements()->attach($this->achievements['bronze']->id, [
        'earned_at' => now()
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Profiel/ProfielResultatenAchievements')
        ->where('achievementTypes.0.achievements.0.is_earned', true)
        ->where('achievementTypes.0.achievements.0.id', $this->achievements['bronze']->id)
    );
});

it('shows achievements that can be earned', function () {
    // Give user enough points for silver but not gold
    $this->user->getProgressForType($this->type)->update([
        'points' => 60
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Profiel/ProfielResultatenAchievements')
        ->has('achievementTypes.0.achievements', fn (Assert $achievements) => $achievements
            ->where('0.can_be_earned', true) // Bronze
            ->where('1.can_be_earned', true) // Silver
            ->where('2.can_be_earned', false) // Gold
        )
    );
});

it('shows correct progress information', function () {
    // Set specific progress
    $this->user->getProgressForType($this->type)->update([
        'points' => 25,
        'last_action_at' => now()
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('profiel.resultaten.achievements', ['tagname' => $this->user->tag_name]));

    $response->assertInertia(fn (Assert $page) => $page
        ->component('Profiel/ProfielResultatenAchievements')
        ->has('achievementTypes.0.progress', fn (Assert $progress) => $progress
            ->where('points', 25)
            ->has('last_action_at')
        )
    );
}); 