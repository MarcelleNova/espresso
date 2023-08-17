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
        Schema::create('call_f_t_p_imports', function (Blueprint $table) {
            $table->id();
            $table->string('callDate')->nullable();
            $table->string('callTime')->nullable();
            $table->string('ringTime')->nullable();
            $table->string('answered')->nullable();
            $table->string('duration')->nullable();
            $table->string('accountCode')->nullable();
            $table->string('fromNumber')->nullable();
            $table->string('extensionName')->nullable();
            $table->string('dialedNumber')->nullable();
            $table->string('destination')->nullable();
            $table->string('ported')->nullable();
            $table->string('cost')->nullable();
            $table->string('fromFile')->nullable();
            $table->string('process')->nullable();
            $table->string('matched')->nullable();
            $table->unique(['callDate', 'callTime','dialedNumber']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_f_t_p_imports');
    }
};
