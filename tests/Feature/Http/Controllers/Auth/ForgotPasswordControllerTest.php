<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('users can request reset password link', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->postJson(route('password.email'), [
        'email' => $user->email,
    ]);

    Notification::assertSentTo($user, ResetPassword::class);
});
