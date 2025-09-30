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
        Schema::create('device_users', function (Blueprint $table) {
            $table->id();
            $table->string('sn')->index();
            $table->string('user_id')->index();
            $table->string('name')->nullable();
            $table->string('card_no')->nullable();
            $table->string('password')->nullable();
            $table->unsignedTinyInteger('privilege')->nullable();
            $table->string('group')->nullable();
            $table->string('timezone')->nullable();
            $table->json('raw_payload')->nullable();
            $table->timestamps();
            $table->unique(['sn', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_users');
    }
};
