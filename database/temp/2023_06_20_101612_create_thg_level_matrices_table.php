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
        Schema::create('thg_level_matrices', function (Blueprint $table) {
            $table->id();
            $table->string('level')->nullable();
            $table->string('percentageOfTarget')->nullable();
            $table->string('leadType')->nullable();
            $table->integer('target')->nullable();
            $table->integer('salesPerDay')->nullable();
            $table->integer('training')->nullable();
            $table->integer('PLBMPLUG')->nullable();
            $table->integer('GPSDrone')->nullable();
            $table->integer('miniDrone')->nullable();
            $table->integer('bumpUpSpareParts')->nullable();
            $table->integer('Upgrade1Tier1')->nullable();
            $table->integer('Upgrade1Tier2')->nullable(); //Upgrade Tier 1 + 10% over threshold
            $table->integer('Updgrade2Threshold')->nullable();
            $table->integer('Upgrade1Tier3')->nullable();
            $table->integer('PLBMPPermissionYes')->nullable();
            $table->integer('PLBMPPermissionNo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thg_level_matrices');
    }
};
