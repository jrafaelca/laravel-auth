<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

test('users can request verification link', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    $response = $this->actingAs($user)
        ->postJson(route('verification.send'));

    $response->assertOk();

    Notification::assertSentTo($user, VerifyEmail::class);
});
