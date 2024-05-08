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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name', 100);
            $table->string('first_name', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password', 254);
            $table->rememberToken();
            $table->string('refresh_token', 254)->nullable()->index();
            $table->foreignId('user_type_id')->references('id')->on('user_types');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1000001');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
