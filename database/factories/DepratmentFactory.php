<?php

namespace Database\Factories;

use App\Models\Depratment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depratment>
 */
class DepratmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Depratment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->title,
            'description' =>fake()->text,
            'icon' => fake()->url,
            'index' => fake()->numberBetween(1,100)
        ];
    }
}
