<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriverStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('driver_statuses')->insert([
            ['name' => 'on_duty'],
            ['name' => 'off_duty'],
            ['name' => 'suspended'],
        ]);
    }
}
