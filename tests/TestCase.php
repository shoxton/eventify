<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function asUser(\App\Models\User $user = null, $guard = 'sanctum')
    {
        if(is_null($user)) {
            $user = \App\Models\User::factory()->create();
        }

        return $this->actingAs($user, $guard);
    }
}
