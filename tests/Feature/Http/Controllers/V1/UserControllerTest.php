<?php

use App\Models\User;

test('users can retrieve profile data', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->getJson(route('v1.user'));

    $response->assertOk();
});
