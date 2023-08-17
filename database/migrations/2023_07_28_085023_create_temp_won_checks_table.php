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
        Schema::create('temp_won_checks', function (Blueprint $table) {
            $table->id();
            $table->string('bxID')->nullable();
            $table->dateTime('bxDateCreate')->nullable();
            $table->dateTime('bxDateModify')->nullable();
            $table->string('bxModifiedBy')->nullable();
            $table->string('bxResponsiblePerson')->nullable();
            $table->string('bxPipeline')->nullable();
            $table->string('bxPipelineCategory')->nullable();
            $table->string('bxVenture')->nullable();
            $table->string('bxVenue')->nullable();
            $table->string('bxDealStage')->nullable();
            $table->string('bxFinalSaleType')->nullable();
            $table->string('bxHistory')->nullable();
            $table->dateTime('bxEndDate')->nullable();
            $table->string('bxBatchNumber')->nullable();
            $table->date('bxLeadReceivedDate')->nullable();
            $table->dateTime('bxAllocationDate')->nullable();
            $table->string('bxReferenceNumber')->nullable();
            $table->decimal('bxNewMembershipFee')->nullable();
            $table->string('bxFirstname')->nullable();
            $table->string('bxSurname')->nullable();
            $table->string('bxLanguage')->nullable();
            $table->string('bxFinalMandateStatus')->nullable();
            $table->date('bxDateOfBirth')->nullable();
            $table->string('bxWorkTel')->nullable();
            $table->string('bxHomeTel')->nullable();
            $table->string('bxCellTel')->nullable();
            $table->string('bxOtherTel')->nullable();
            $table->string('bxAccHolderTel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_won_checks');
    }
};
