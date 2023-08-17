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
        Schema::create('call_data', function (Blueprint $table) {
            $table->id();
            $table->date('callMonth')->nullable();
            $table->date('salaryMonth')->nullable();
            $table->string('phoneID')->nullable();
            $table->string('venue')->nullable();
            $table->string('venture')->nullable();
            $table->string('company')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('ringTime')->nullable();
            $table->string('duration')->nullable();
            // $table->string('durationCalc')->nullable();
            // $table->string('accountCode')->nullable();
            $table->string('dialType')->nullable();
            $table->string('fromNumber')->nullable();
            $table->string('extension')->nullable();
            $table->string('extensionName')->nullable();
            $table->string('dialedNumber')->nullable();
            // $table->string('destination')->nullable();
            // $table->string('ported')->nullable();
            $table->string('answered')->nullable();
            $table->decimal('cost',10,5)->nullable();
            $table->string('source')->nullable();
            $table->string('numberExtract')->nullable();
            $table->string('extExtension')->nullable();
            $table->string('callHour')->nullable();
            $table->string('phoneExtTSRID')->nullable();
            $table->string('bitrixTSR')->nullable();
            $table->string('bitrixdID')->nullable();
            $table->string('uniqueUsers')->nullable();
            $table->string('matchedWon')->nullable();
            $table->string('matchedModBitrix')->nullable();
            $table->string('matchedModScreenshot')->nullable();
            $table->string('matchedViewed')->nullable();
            $table->string('matchedLast20Days')->nullable();
            $table->string('matchedAny')->nullable();
            $table->string('matchedWith')->nullable();
            $table->string('FINAL')->nullable();
            $table->string('finalVentureID')->nullable();
            $table->string('finalVenueID')->nullable();
            $table->string('finalPipelineID')->nullable();
            $table->string('finalDealCategoryID')->nullable();
            $table->string('finalRefNumber')->nullable();
            $table->string('finalSalesOption')->nullable();
            $table->string('matchedRTO')->nullable();
            $table->unique(['date', 'time','dialedNumber']);
            $table->string('count')->nullable();
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_data');
    }
};
