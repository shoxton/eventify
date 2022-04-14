<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleSessionTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_instantiates_a_schedule_session()
    {

        $session = new \App\Models\ScheduleSession();

        $this->assertNotNull($session);

    }

    public function test_it_persists_a_schedule_session_to_db()
    {

        $event = \App\Models\Event::factory()->create();

        $session = \App\Models\ScheduleSession::factory()->create([
            'title' => 'Talk #1 - Lorem dolor',
            'description' => 'Lorem ipsum dolor sit amet',
            'stage' => 'Stage XYZ',
            'starts_at' => '2022-04-03 08:00:00',
            'ends_at' => '2022-04-03 10:00:00',
            'access' => \App\Models\Event::ACCESS_RESTRICTED,
            'event_id' => $event->id
        ]);

        $this->assertDatabaseHas('schedule_sessions', [
            'title' => $session->title,
            'description' => $session->description,
            'stage' => $session->stage,
            'starts_at' => $session->starts_at,
            'ends_at' => $session->ends_at,
            'access' => $session->access,
        ]);

    }

    public function test_it_has_belongs_to_event_relationship()
    {

        $event = \App\Models\Event::factory()->create();

        $scheduleSession = \App\Models\ScheduleSession::factory()->create(['event_id' => $event->id]);

        $this->assertInstanceOf(\App\Models\Event::class, $scheduleSession->event);
        $this->assertEquals($scheduleSession->event->id, $event->id);

    }
}
