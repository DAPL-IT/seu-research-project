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
        Schema::create('rent_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('type');
            $table->boolean('status')->comment('0=archived, 1=live')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_types');
    }
};
