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
        Schema::create('temp_phone_movements', function (Blueprint $table) {
            $table->id();
            $table->string('saicomUsername')->nullable();
            $table->string('site')->nullable();
            $table->string('displayName')->nullable();
            $table->boolean('active')->nullable();
            $table->string('venture')->nullable();
            $table->string('phoneCategory')->nullable();
            $table->string('employmentType')->nullable();
            $table->string('venue')->nullable();
            $table->string('company')->nullable();
            $table->date('assigned_date')->nullable();
            $table->date('removed_date')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_phone_movements');
    }
};
