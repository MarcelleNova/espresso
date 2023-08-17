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
        Schema::create('lead_sources', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->nullable();
            $table->string('company')->nullable();
            $table->string('venture')->nullable();
            $table->string('phoneVenture')->nullable();
            $table->string('paymentVenture')->nullable();
            $table->string('venue')->nullable();
            $table->string('parentPipeline')->nullable();
            $table->string('pipeline')->nullable();
            $table->string('oldPipeline')->nullable();
            $table->string('dealCategory')->nullable();
            $table->string('leadCategory')->nullable();
            $table->string('paymentCategory')->nullable();
            $table->string('UDFS')->nullable();
            $table->string('debiCheckProcess')->nullable();
            $table->string('debiCheckVentureLookup')->nullable();
            $table->string('leadSource')->nullable();
            $table->string('leadSourceBatch')->nullable();
            $table->string('leadGroup')->nullable();
            $table->string('TSRLeadGroup')->nullable();
            $table->string('PTOffer')->nullable();
            $table->string('PTOffer')->nullable();
            $table->date('dateAdded')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_sources');
    }
};
