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
        Schema::create('importation_status_history', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->enum('old_status', ['pending', 'rejected', 'missing_file', 'doing', 'completed']);
            $table->enum('new_status', ['pending', 'rejected', 'missing_file', 'doing', 'completed']);
            $table->text('message')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('importation_id')->references('id')->on('importations');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE importation_status_history AUTO_INCREMENT = 1000000001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('importation_status_history', function (Blueprint $table) {
            //
        });
    }
};
