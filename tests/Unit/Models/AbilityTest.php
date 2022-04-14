<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_ability_can_be_instantiated()
    {

        $ability = new \App\Models\Ability();

        $this->assertNotNull($ability);

    }

    public function test_an_ability_is_persisted_to_db()
    {

        $ability = \App\Models\Ability::factory()->create();

        $this->assertNotNull($ability);
        $this->assertInstanceOf(\App\Models\Ability::class, $ability);
        $this->assertDatabaseHas('abilities', [
            'id' => $ability->id,
            'name' => $ability->name
        ]);

    }

    public function test_an_ability_belongs_to_many_roles()
    {

        $ability = \App\Models\Ability::factory()->create();
        $role = \App\Models\Role::factory()->create();

        $ability->roles()->save($role);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $ability->roles);
        $this->assertCount(1, $ability->roles);
        $this->assertInstanceOf(\App\Models\Role::class, $ability->roles()->first());

    }
}
