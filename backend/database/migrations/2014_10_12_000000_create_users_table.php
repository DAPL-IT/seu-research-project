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
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 15)->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('nid')->unique()->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('role');
            $table->unsignedTinyInteger('locked')->default(0)->comment('1=user is locked, 0=user can access facilities');
            $table->unsignedTinyInteger('online')->default(0)->comment('0=user is not online, 1 = user is online');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'name', 'email', 'role', 'locked', 'online']);
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
