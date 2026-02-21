<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('license_types')->insert([
            ['name' => 'LMV'],
            ['name' => 'HMV'],
            ['name' => 'Transport'],
            ['name' => 'Heavy Commercial'],
        ]);
    }
}
