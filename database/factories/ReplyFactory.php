<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        if (fake()->boolean()) {
            $replyableId = Customer::orderByRaw('RAND()')->first()->id;
            $replyableType = Customer::class;
        } else {

            $replyableId = User::orderByRaw('RAND()')->first()->id;
            $replyableType = User::class;
        }

        return [
            'replyable_id' => $replyableId,
            'replyable_type' => $replyableType,
            'ticket_id' => Ticket::orderByRaw('RAND()')->first()->id,
            'content' => fake()->realText,
            'rate' => fake()->numberBetween(1, 10),
            'ip' => fake()->ipv4()
        ];
    }
}
