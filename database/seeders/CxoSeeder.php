<?php

namespace Database\Seeders;

use App\Models\Cxo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CxoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $positions = ['CEO', 'CTO', 'CFO', 'COO', 'CMO'];

        foreach ($positions as $position) {
            Cxo::create(['position' => $position]);
        }
    }
}
