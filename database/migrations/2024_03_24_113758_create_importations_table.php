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
        Schema::create('importations', function (Blueprint $table) {
            $table->id();
            $table->string('type_product');
            $table->string('country_origin');
            $table->string('country_from');
            $table->string('destination');
            $table->string('dock_loading');
            $table->string('dock_unloading');
            $table->float('value');
            $table->string('type_transaport');
            $table->string('facture_url');
            $table->integer('weight');
            $table->integer('quantity');
            $table->string('transitaire');
            $table->foreignId('entreprise_id')->references('id')->on('entreprises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importations');
    }
};
