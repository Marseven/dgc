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
            $table->string('gerant')->nullable();
            $table->string('arrond')->nullable();
            $table->string('bp')->nullable();
            $table->string('number_agrement')->nullable();
            $table->string('provider')->nullable();
            $table->string('adress_provider')->nullable();
            $table->string('transitaire')->nullable();
            $table->string('phone_transitaire')->nullable();
            $table->string('adress_transitaire')->nullable();
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
