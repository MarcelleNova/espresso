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
        Schema::create('call_midday_imports', function (Blueprint $table) {
            $table->id();
            $table->date('callDate')->nullable();
            $table->time('callTime')->nullable();
            $table->time('ringTime')->nullable();
            $table->string('answered')->nullable();
            $table->time('duration')->nullable();
            $table->string('accountCode')->nullable();
            $table->string('fromNumber')->nullable();
            $table->string('extensionName')->nullable();
            $table->string('dialedNumber')->nullable();
            $table->string('destination')->nullable();
            $table->string('ported')->nullable();
            $table->decimal('cost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_midday_imports');
    }
};
