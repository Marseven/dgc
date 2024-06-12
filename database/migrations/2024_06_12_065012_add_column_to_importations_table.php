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
        Schema::table('importations', function (Blueprint $table) {
            //
            $table->enum('status', ['pending', 'rejected', 'missing_file', 'completed'])->default('pending');
            $table->text('message_reject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('importations', function (Blueprint $table) {
            //
        });
    }
};
