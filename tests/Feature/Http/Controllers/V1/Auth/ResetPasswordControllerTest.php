<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('users can reset password with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->postJson(route('v1.auth.forgot-password'), [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPassword::class, function (object $notification) use ($user) {
        $response = $this->postJson(route('v1.auth.reset-password'), [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertStatus(200);

        return true;
    });
});
