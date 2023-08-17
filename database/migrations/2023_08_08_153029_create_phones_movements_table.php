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
        Schema::create('phones_movements', function (Blueprint $table) {
            $table->id();
            $table->string('phoneID')->nullable();
            $table->boolean('active')->nullable();
            $table->dateTime('assigned_date')->nullable();
            $table->dateTime('removed_date')->nullable();
            $table->string('company')->nullable();
            $table->string('site')->nullable();
            $table->string('venue')->nullable();
            $table->string('venture')->nullable();
            $table->string('phoneCategory')->nullable();
            $table->string('employmentType')->nullable();
            $table->string('assignedToUserID')->nullable();
            $table->string('assignedToUserName')->nullable();
            $table->string('movedByUserID')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones_movements');
    }
};
