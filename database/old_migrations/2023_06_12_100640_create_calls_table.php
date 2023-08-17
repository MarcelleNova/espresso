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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('venue')->nullable();
            $table->date('callDate')->nullable();
            $table->time('callTime')->nullable();
            $table->time('callDuration')->nullable();
            $table->string('extNumber')->nullable();
            $table->integer('user')->nullable();
            $table->string('dialedNumber')->nullable();
            $table->string('destination')->nullable();
            $table->string('callType')->nullable();
            $table->decimal('charge')->nullable();
            $table->string('file')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
