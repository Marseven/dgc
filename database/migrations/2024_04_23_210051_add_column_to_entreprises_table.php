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
        Schema::table('entreprises', function (Blueprint $table) {
            //
            $table->string('commune')->nullable();
            $table->string('hood')->nullable();
            $table->string('business_circuit')->nullable();
            $table->string('nif')->nullable();
            $table->date('date_create')->nullable();
            $table->string('email')->nullable();
            $table->string('legal_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            //
        });
    }
};
