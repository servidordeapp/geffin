<?php

use App\Models\User;

test('User can view dashboard', function () {

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200);
});
