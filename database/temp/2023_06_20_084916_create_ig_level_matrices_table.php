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
    {  // For Salary Calender Matrix : Upgrade 1 - 4, Base 1-5, Hybrid
        Schema::create('ig_level_matrices', function (Blueprint $table) {
            $table->id();
            $table->string('level')->nullable();
            $table->string('percentageOfTarget')->nullable();
            $table->string('leadType')->nullable();
            $table->integer('fullPPS')->nullable();
            $table->integer('miniPPS')->nullable();
            $table->integer('salesPPS')->nullable();
            $table->integer('averageExpectedSalary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_matrices');
    }
};
