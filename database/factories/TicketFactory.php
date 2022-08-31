<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject' => fake()->word(),
            'content' => fake()->text(),
            'priority' => fake()->numberBetween(1,3),
            'active' => fake()->boolean(),
            'ip' => fake()->ipv4(),
            'customer_id' => fake()->numberBetween(1,10),
            'service_id' => fake()->numberBetween(1,10),
            'department_id' => fake()->numberBetween(1,10)
        ];
    }
}
