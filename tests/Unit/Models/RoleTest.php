<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{

    use RefreshDatabase;

    public function test_a_role_can_be_instantiated()
    {

        $role = new \App\Models\Role();

        $this->assertNotNull($role);

    }

    public function test_a_role_is_persisted_to_db()
    {

        $role = \App\Models\Role::factory()->create(['name' => \App\Models\Role::ROLE_OWNER]);

        $this->assertNotNull($role);
        $this->assertInstanceOf(\App\Models\Role::class, $role);
        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => $role->name
        ]);

    }

    public function test_a_role_belongs_to_many_abilities()
    {

        $role = \App\Models\Role::factory()->create();
        $ability = \App\Models\Ability::factory()->create();

        $role->abilities()->save($ability);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $role->abilities);
        $this->assertCount(1, $role->abilities);
        $this->assertInstanceOf(\App\Models\Ability::class, $role->abilities()->first());

    }

    public function test_role_has_allowTo_method()
    {

        $manager = \App\Models\Role::factory()->create(['name' => 'manager']);
        $editEvent = \App\Models\Ability::factory()->create(['name' => 'edit_event']);

        $manager->allowTo($editEvent);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $manager->abilities);
        $this->assertCount(1, $manager->abilities);
        $this->assertInstanceOf(\App\Models\Ability::class, $manager->abilities()->first());
        $this->assertEquals('edit_event', $manager->abilities()->first()['name']);

    }
}
