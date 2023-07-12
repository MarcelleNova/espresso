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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('empID')->nullable();
            $table->string('empType')->nullable();
            $table->string('company')->nullable();
            $table->string('venue')->nullable();
            $table->string('venture')->nullable();
            $table->string('department')->nullable();
            $table->string('TSRType')->nullable();
            $table->string('designation')->nullable();
            $table->string('reports_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
