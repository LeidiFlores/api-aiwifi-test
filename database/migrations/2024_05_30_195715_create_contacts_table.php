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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('estimates_gender')->nullable();
            $table->double('probability_gender')->nullable();
            $table->string('estimates_age')->nullable();
            $table->string('estimates_nationality')->nullable();
            $table->double('probability_nationality')->nullable();
            $table->boolean('mail_smtp_check')->nullable();
            $table->boolean('mail_role')->nullable();
            $table->boolean('mail_disposable')->nullable();
            $table->boolean('mail_free')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
