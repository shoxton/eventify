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
}
