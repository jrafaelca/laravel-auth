<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Laravel\Sanctum\Sanctum;

test('users can request verification link', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson(route('v1.auth.verification.resend'));

    $response->assertNoContent();

    Notification::assertSentTo($user, VerifyEmail::class);
});
