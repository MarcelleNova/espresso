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
        Schema::create('saicoms', function (Blueprint $table) {
            $table->id();
            $table->string('startTime')->nullable();
            $table->string('groupName')->nullable();
            $table->string('userID')->nullable();
            $table->string('fromNumber')->nullable();
            $table->string('dialedNumber')->nullable();
            $table->string('answered')->nullable();
            $table->string('answerTime')->nullable();
            $table->string('releaseTime')->nullable();
            $table->string('terminationCause')->nullable();
            $table->string('trackingID')->nullable();
            $table->string('callID')->nullable();
            $table->string('groupNumber')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saicoms');
    }
};
