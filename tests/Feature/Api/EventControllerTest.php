<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_event_index_route_lists_events()
    {


        $user = \App\Models\User::factory()->create();
        $events = \App\Models\Event::factory()->times(5)->create(['producer_id' => 1]);


        $this->asUser($user)->getJson('api/events')
            ->assertOk();

    }

    public function test_event_store_route_creates_an_event()
    {

        $this->post('events', [
            'name' => 'Lorem ipsum',
            'description' => 'Dolor sit amet consectur.',
            'access' => \App\Models\Event::ACCESS_PUBLIC,
            'mode' => \App\Models\Event::MODE_ONLINE
        ])->assertOk();

    }
}
