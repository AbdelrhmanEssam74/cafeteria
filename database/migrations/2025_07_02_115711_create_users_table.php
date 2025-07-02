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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Full name
            $table->string('email')->unique(); // Unique email for login
            $table->string('password'); // Hashed password
            $table->string('room_number')->nullable(); // Room number for delivery
            $table->string('ext')->nullable(); // Internal extension
            $table->enum('role', ['admin', 'user'])->default('user'); // User role
            $table->string('image')->nullable(); // Profile image path
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
