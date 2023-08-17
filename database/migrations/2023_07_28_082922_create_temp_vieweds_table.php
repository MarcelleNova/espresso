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
        Schema::create('temp_vieweds', function (Blueprint $table) {
            $table->id();
            // $table->string('bxID')->nullable();
            $table->dateTime('bxDateCreate')->nullable();
            $table->string('bxResponsiblePerson')->nullable();
            $table->string('bxEntityID')->nullable();
            $table->string('bxPipeline')->nullable();
            $table->string('bxPipelineCategory')->nullable();
            $table->string('bxDealCategory')->nullable();
            $table->string('bxVenture')->nullable();
            $table->string('bxVenue')->nullable();
            $table->string('bxDealStage')->nullable();
            $table->string('bxReferenceNumber')->nullable();
            $table->string('bxWorkTel')->nullable();
            $table->string('bxHomeTel')->nullable();
            $table->string('bxCellTel')->nullable();
            $table->string('bxOtherTel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_vieweds');
    }
};
