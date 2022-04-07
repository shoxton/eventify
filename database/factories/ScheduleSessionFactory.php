<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleSession>
 */
class ScheduleSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'access' => \App\Models\Event::ACCESS_RESTRICTED,
            'starts_at' => \Carbon\Carbon::now(),
            'ends_at' => \Carbon\Carbon::now()->addHours(2),
        ];
    }
}
