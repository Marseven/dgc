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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('service');
            $table->string('referent');
            $table->string('referent_contact');
            $table->integer('activity_id')->references('id')->on('activities');
            $table->integer('entreprise_id')->references('id')->on('entreprises');
            $table->integer('declaration_type_id')->references('id')->on('declaration_types');
            $table->integer('product_type_id')->references('id')->on('product_types');
            $table->integer('logistic_id')->references('id')->on('logistics');
            $table->string('province');
            $table->string('ville');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
