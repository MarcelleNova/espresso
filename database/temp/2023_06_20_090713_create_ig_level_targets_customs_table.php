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
        Schema::create('ig_level_targets_customs', function (Blueprint $table) {
            $table->id();
            $table->string('leadType')->nullable();
            $table->string('leadTypeNumber')->nullable();
            $table->string('description')->nullable();
            $table->string('averageExpectedSalary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ig_level_targets_customs');
    }
};
