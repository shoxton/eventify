<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_belongs_to_many_roles()
    {

        $user = \App\Models\User::factory()->create();
        $role = \App\Models\Role::factory()->create();

        $user->roles()->save($role);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $user->roles);
        $this->assertCount(1, $user->roles);
        $this->assertInstanceOf(\App\Models\Role::class, $user->roles()->first());

    }

    public function test_user_has_assignRole_method()
    {

        $user = \App\Models\User::factory()->create();
        $manager = \App\Models\Role::factory()->create(['name' => 'manager']);

        $user->assignRole($manager);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $user->roles);
        $this->assertCount(1, $user->roles);
        $this->assertInstanceOf(\App\Models\Role::class, $user->roles()->first());
        $this->assertEquals('manager', $user->roles()->first()['name']);

    }

    public function test_user_assigns_role_passing_a_string()
    {

        $user = \App\Models\User::factory()->create();
        $manager = \App\Models\Role::factory()->create(['name' => 'manager']);

        $user->assignRole('manager');

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $user->roles);
        $this->assertCount(1, $user->roles);
        $this->assertInstanceOf(\App\Models\Role::class, $user->roles()->first());
        $this->assertEquals('manager', $user->roles()->first()['name']);

    }

    public function test_user_has_many_events_relationship()
    {

        $user = \App\Models\User::factory()->create();
        $event = \App\Models\Event::factory()->make()->toArray();

        $user->events()->create($event);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $user->events);
        $this->assertCount(1, $user->events);
        $this->assertInstanceOf(\App\Models\Event::class, $user->events()->first());

    }
}
