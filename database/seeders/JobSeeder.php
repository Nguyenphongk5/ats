<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            Job::create([
                'name' => $faker->jobTitle,
                'description' => $faker->paragraph,
                'open_date' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                'close_date' => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
                'user_id' => 1,
            ]);
        }
    }
}
