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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->unique();
            $table->string('postal_code');
            $table->string('phone', 15);
            $table->string('localisation')->nullable();
            $table->string('number_commercant');
            $table->string('number_statistic')->nullable();
            $table->string('rccm');
            $table->foreignId('activity_id')->references('id')->on('activities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};
