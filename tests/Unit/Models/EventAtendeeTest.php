<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventAttendeeTest extends TestCase
{

    use RefreshDatabase;

   public function test_it_instantiates_an_event_attendee()
   {

       $attendee = new \App\Models\EventAttendee();

       $this->assertNotNull($attendee);

   }

   public function test_it_persists_event_attendee_to_db()
   {

       $attendee = \App\Models\EventAttendee::factory()->create([
           'name' => 'John Adams',
           'title' => 'CEO at XYZ',
           'description' => 'Lorem ipsum dolor sit amet.',
           'additional_info' => json_encode([
               'website' => 'http://example.com',
               'twitter' => 'http://twitter.com/jadams'
           ])
       ]);

       $this->assertDatabaseHas('event_attendees', [
           'id' => $attendee->id,
           'name' => $attendee->name,
           'title' => $attendee->title,
           'description' => $attendee->description,
       ]);

   }

   public function test_it_has_belongs_to_event_relationship()
    {

        $event = \App\Models\Event::factory()->create();
        $attendee = \App\Models\EventAttendee::factory()->create(['event_id' => $event->id]);

        $this->assertInstanceOf(\App\Models\Event::class, $attendee->event);
        $this->assertEquals($event->id, $attendee->event->id);

    }
}
