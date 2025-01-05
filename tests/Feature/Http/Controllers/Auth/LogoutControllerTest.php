<?php

use App\Models\User;

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->postJson(route('logout'));

    $this->assertGuest();

    $response->assertNoContent();
});
