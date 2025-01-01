<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(fn () => $this->withHeader('Referer', config('app.frontend_url')));

test('users can logout', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->deleteJson(route('v1.auth.logout'));

    $this->assertGuest('web');

    $response->assertNoContent();
});
