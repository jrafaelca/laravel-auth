<?php

use App\Models\User;

beforeEach(fn () => $this->withHeader('Referer', config('app.frontend_url')));

test('users can log in with valid credentials', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('v1.auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated('web');

    $response->assertNoContent();
});

test('users cannot login with invalid credentials', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('v1.auth.login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors([
            'email' => __('auth.failed'),
        ]);
});
