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
        Schema::create('rent_classifications', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('classification');
            $table->integer('from');
            $table->integer('to');
            $table->string('slug');
            $table->timestamps();

            $table->index(['id', 'classification', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_classifications');
    }
};
