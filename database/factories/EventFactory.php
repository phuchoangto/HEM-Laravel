<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->text,
            'start_at' => Carbon::now()->addDays(3),
            'end_at' => Carbon::now()->addDay(6),
            'location' => $this->faker->address,
            'image' => '/public/storage/images/default-event-image.jpg',
            'faculty_id' => 1,
        ];
    }
}
