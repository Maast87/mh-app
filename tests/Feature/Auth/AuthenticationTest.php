<?php

use App\Events\UserLoggedIn;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can render login screen', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('can authenticate users using login screen', function () {
    $response = $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home'));
});

it('cannot authenticate with invalid password', function () {
    $this->post('/login', [
        'email' => $this->user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

it('dispatches user logged in event on successful login', function () {
    Event::fake([UserLoggedIn::class]);

    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    Event::assertDispatched(UserLoggedIn::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });
});

it('can logout users', function () {
    $response = $this->actingAs($this->user)
        ->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/tot-snel');
});
