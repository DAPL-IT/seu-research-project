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
        Schema::create('surface_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone', 15)->nullable();
            $table->string('nid')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('locked')->default(0)->comment('1=user is locked, 0=user can access facilities');
            $table->unsignedTinyInteger('online')->default(0)->comment('0=user is not online, 1 = user is online');
            $table->string('token')->nullable()->comment('It can be used as pwd reset token and email verification token');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surface_users');
    }
};
