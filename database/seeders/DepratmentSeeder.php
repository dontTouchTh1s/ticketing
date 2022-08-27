<?php

namespace Database\Seeders;

use App\Models\Depratment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depratment::factory()
            ->hasTickets(3)
            ->create();
    }
}
