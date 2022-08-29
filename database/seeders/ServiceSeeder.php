<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::factory()
            ->hasAttached(Customer::factory()
                ->count(2),  [
                'started_at' => date('Y/m/d'),
                'end_at' => date('Y/m/d'),
                'active' => fake()->boolean
            ])
            ->count(10)
            ->create();
    }
}
