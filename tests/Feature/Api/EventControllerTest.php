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
        $events = \App\Models\Event::factory()->times(5)->create(['producer_id' => $user->id]);


        $this->getJson('api/events')
            ->assertJson([
                'data' => [
                    [
                        'id' => $events[0]->id,
                        'title' => $events[0]->title
                    ]
                ],
                'meta' => [
                    'total' => 5
                ]
            ])
            ->assertOk();

    }

    public function test_event_show_route_shows_event()
    {
        $user = \App\Models\User::factory()->create();
        $event = \App\Models\Event::factory()->create(['producer_id' => $user->id]);


        $this->getJson("api/events/$event->id")
            ->assertJson([
                'data' => [
                    'id' => $event->id,
                    'title' => $event->title
                ],
            ])
            ->assertOk();

    }

    public function test_event_store_route_creates_an_event()
    {

        $user = \App\Models\User::factory()->create();

        $this->postJson("api/events", [])
            ->assertUnauthorized()
            ->assertStatus(401);

        $this->asUser($user)->postJson("api/events", [
            'title' => 'Lorem ipsum dolor',
            'access' => 'public',
            'mode' => 'online',
            'producer_id' => $user->id
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'title' => 'Lorem ipsum dolor'
                ]
            ]);

        $this->assertDatabaseHas('events', [
            'id' => 1,
            'title' => 'Lorem ipsum dolor'
        ]);


    }
}
