<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\Sanctum;

test('users can verify email address', function () {
    $user = User::factory()
        ->unverified()
        ->create();

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'v1.auth.verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    Sanctum::actingAs($user);

    $response = $this->getJson($verificationUrl);

    Event::assertDispatched(Verified::class);

    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();

    $response->assertNoContent();
});


test('users can not verify email address with invalid hash', function () {
    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'v1.auth.verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    Sanctum::actingAs($user);

    $this->getJson($verificationUrl);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
