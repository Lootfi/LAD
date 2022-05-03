<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('has login page', function () {

    $user = User::query()->first();


    $this->actingAs($user)
        ->get('/login')
        ->assertRedirect();

    // $response
    //     ->assertSee('Email')
    //     ->assertSee('Password')
    //     ->assertSee('Remember Me')
    //     ->assertSee('Sign in');
});
