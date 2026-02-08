<?php

namespace Database\Seeders;

use App\Models\Tech;
use Illuminate\Database\Seeder;

class TechSeeder extends Seeder
{
    public function run(): void
    {
        Tech::truncate();

        Tech::create([
            'title' => 'github',
            'description' => null,
            'sort_order' => 1,
        ]);

        Tech::create([
            'title' => 'payment',
            'description' => 'pyement with many payment gateways like hyperpay, tap, paymob, and more. and can handle good with any payment process and handle all the steps of it with good performance and security.',
            'sort_order' => 2,
        ]);

        Tech::create([
            'title' => 'CI/CD',
            'description' => null,
            'sort_order' => 3,
        ]);

        Tech::create([
            'title' => 'testing',
            'description' => null,
            'sort_order' => 4,
        ]);

        Tech::create([
            'title' => 'HMVC',
            'description' => null,
            'sort_order' => 5,
        ]);

        Tech::create([
            'title' => 'React',
            'description' => null,
            'sort_order' => 6,
        ]);
    }
}
