<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trip_expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('distance', 10, 2)->default(0);
            $table->decimal('fuel_expense', 10, 2)->default(0);
            $table->decimal('misc_expense', 10, 2)->default(0);

            $table->enum('status', [
                'pending',
                'approved'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_expenses');
    }
};
