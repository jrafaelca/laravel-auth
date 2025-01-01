<?php

use App\Models\User;

test('users can create an account', function () {
    $formData = User::factory()
        ->raw();

    $response = $this->postJson(route('v1.auth.register'), $formData);

    $response->assertNoContent();
});
