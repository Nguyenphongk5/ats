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
             'title' => 'Lập trình viên PHP',
    'description' => 'Viết backend bằng Laravel',
    'start_date' => now(),
    'status' => 'open', // ✅ Thay vì is_open
    'type' => 'manager','specialist',
    'company_id' => 1,
    'created_at' => now(),
    'updated_at' => now(),
            ]);

        }
    }
}
