<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 70);
            $table->string('description', 100);
            $table->foreignId('user_type_id')->references('id')->on('user_types');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE privileges AUTO_INCREMENT = 101');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privileges');
    }
};
