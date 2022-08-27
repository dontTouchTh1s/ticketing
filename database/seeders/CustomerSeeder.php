<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()
            ->hasAttached(Service::factory()->count(5), [
                'started_at' => date('Y/m/d'),
                'end_at' => date('Y/m/d'),
                'active' => fake()->boolean
                ])
            ->hasTickets(10)
            ->create();

    }
}
