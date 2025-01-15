<?php

namespace Database\Seeders;

use App\Models\Check;
use Illuminate\Database\Seeder;

class CheckSeeder extends Seeder
{
    public function run()
    {
        Check::firstOrCreate(
            ['id' => 1],
            ['name' => 'Belastbaarheid']
        );

        Check::firstOrCreate(
            ['id' => 2],
            ['name' => 'Test']
        );
    }
}
