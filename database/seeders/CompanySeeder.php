<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Company::insert([
            [
                'name' => 'CMC Corporation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CMC Global',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
