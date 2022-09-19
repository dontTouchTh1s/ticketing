<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Group;
use App\Models\Service;
use Exception;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Service::factory()
            ->hasAttached(Customer::factory()
                ->hasAttached(Group::factory()
                    ->count(1)
                )
                ->count(2), [
                'started_at' => date('Y/m/d'),
                'end_at' => date('Y/m/d'),
                'active' => fake()->boolean
            ])
            ->count(10)
            ->create();
    }
}
