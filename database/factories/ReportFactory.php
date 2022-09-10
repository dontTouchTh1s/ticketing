<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reply;
use App\Models\Report;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if (fake()->boolean()) {
            $reportableId = Ticket::orderByRaw('RAND()')->first()->id;
            $reportableType = Ticket::class;
        } else {

            $reportableId = Reply::orderByRaw('RAND()')->first()->id;
            $reportableType = Reply::class;
        }
        if (fake()->boolean()) {
            $senderId = User::orderByRaw('RAND()')->first()->id;
            $senderType = User::class;
        } else {

            $senderId = Customer::orderByRaw('RAND()')->first()->id;
            $senderType = Customer::class;
        }

        return [
            'reportable_id' => $reportableId,
            'reportable_type' => $reportableType,
            'sender_id' => $senderId,
            'sender_type' => $senderType,
            'content' => fake()->realText,
        ];
    }
}
