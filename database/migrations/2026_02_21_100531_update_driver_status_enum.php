<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        ALTER TABLE drivers
        MODIFY status ENUM(
            'on_duty',
            'on_trip',
            'off_duty',
            'suspended'
        ) DEFAULT 'off_duty'
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
