<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('driver_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('cargo_weight');
            $table->string('origin');
            $table->string('destination');

            $table->enum('status', [
                'draft',
                'dispatched',
                'completed',
                'cancelled',
            ])->default('draft');

            $table->integer('start_odometer')->nullable();
            $table->integer('end_odometer')->nullable();

            $table->decimal('revenue', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
