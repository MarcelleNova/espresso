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
        Schema::create('lead_type_details', function (Blueprint $table) {
            $table->id();
            $table->string('company')->nullable();
            $table->string('campaign')->nullable();
            $table->string('leadType')->nullable();   //Upgrade or Base, Hybrid or Training frpm IG Lead Table
            $table->string('leadTypeNumber')->nullable();  // 1 or 2
            $table->string('product')->nullable(); //Perfume BC
            $table->string('additional_1')->nullable(); //BC , AFRICAN
            $table->string('additional_2')->nullable();
            $table->string('additional_3')->nullable();
            $table->string('comboDescription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_type_details');
    }
};
