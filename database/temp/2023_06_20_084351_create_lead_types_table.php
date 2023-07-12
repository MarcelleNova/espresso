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
    {  // For IG Lead Types Base Uprade Hybrid Training
        Schema::create('lead_types', function (Blueprint $table) {
            $table->id();
            $table->string('campaign')->nullable();
            $table->string('type')->nullable(); // Upgrade or Base
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_types');
    }
};
