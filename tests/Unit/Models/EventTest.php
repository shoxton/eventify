<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_instantiates_an_event()
    {

        $event = new \App\Models\Event();

        $this->assertNotNull($event);

    }

    public function test_it_persists_an_event_to_db()
    {

        $event = \App\Models\Event::factory()->create([
            'title' => 'Lorem ipsum',
            'description' => 'Ipsum dolor sit amet.',
            'rich_text' => '<p>Lorem ipsum <strong>dolor sit</strong> amet consectur.',
            'mode' => \App\Models\Event::MODE_ONLINE,
            'access' => \App\Models\Event::ACCESS_PUBLIC,
        ]);

        $this->assertNotNull($event);
        $this->assertDatabaseHas('events', [
            'title' => $event->title,
            'id' => $event->id,
            'rich_text' => $event->rich_text,
            'access' => $event->access,
        ]);

    }

    public function test_it_has_many_attendees_relationship()
    {

        $event = \App\Models\Event::factory()->create();

        $attendee = new \App\Models\EventAttendee(['name' => 'John Doe']);

        $event->attendees()->save($attendee);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $event->attendees);
        $this->assertCount(1, $event->attendees);
        $this->assertInstanceOf(\App\Models\EventAttendee::class, $event->attendees()->first());

    }

    public function test_it_has_many_schedule_sessions_relationship()
    {

        $event = \App\Models\Event::factory()->create();

        $scheduleSession = \App\Models\ScheduleSession::factory()->make();

        $event->scheduleSessions()->save($scheduleSession);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $event->scheduleSessions);
        $this->assertCount(1, $event->scheduleSessions);
        $this->assertInstanceOf(\App\Models\ScheduleSession::class, $event->scheduleSessions()->first());

    }

    public function test_event_belongs_to_user_relationship()
    {

        $user = \App\Models\User::factory()->create();
        $event = \App\Models\Event::factory()->create(['producer_id' => $user->id]);

        $this->assertNotNull($event->producer);
        $this->assertInstanceOf(\App\Models\User::class, $event->producer);
        $this->assertEquals($user->name, $event->producer->name);

    }
}
