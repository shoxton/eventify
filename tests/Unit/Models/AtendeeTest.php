<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendeeTest extends TestCase
{

    use RefreshDatabase;

   public function test_it_instantiates_an_event_attendee()
   {

       $attendee = new \App\Models\Attendee();

       $this->assertNotNull($attendee);

   }

   public function test_it_persists_event_attendee_to_db()
   {

       $attendee = \App\Models\Attendee::factory()->create([
           'name' => 'John Adams',
           'title' => 'CEO at XYZ',
           'description' => 'Lorem ipsum dolor sit amet.',
           'additional_info' => json_encode([
               'website' => 'http://example.com',
               'twitter' => 'http://twitter.com/jadams'
           ])
       ]);

       $this->assertDatabaseHas('attendees', [
           'id' => $attendee->id,
           'name' => $attendee->name,
           'title' => $attendee->title,
           'description' => $attendee->description,
       ]);

   }

   public function test_it_has_events_many_to_many_relationship()
    {

        $attendee = \App\Models\Attendee::factory()->create();
        $event = \App\Models\Event::factory()->create();

        $attendee->events()->save($event);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $attendee->events);
        $this->assertCount(1, $attendee->events);
        $this->assertInstanceOf(\App\Models\Event::class, $attendee->events()->first());

    }
}
