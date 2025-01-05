<?php

use App\Models\User;

test('users can create an account', function () {
    $formData = User::factory()->raw();

    $response = $this->postJson(route('register'), [
        ...$formData,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertNoContent();
});
