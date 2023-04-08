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
        Schema::create('rent_ads', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('title');
            $table->string('image')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedMediumInteger('rooms');
            $table->unsignedMediumInteger('bathrooms');
            $table->unsignedMediumInteger('floor');
            $table->text('full_address');
            $table->mediumText('description');
            $table->unsignedTinyInteger('status')->comment('1 = approved, 2 = pending, 0 = rejected, 3 = changes are required')->default(2);
            $table->boolean('is_featured')->nullable();
            $table->boolean('sold_on_site')->nullable();

            $table->unsignedSmallInteger('rent_type_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('poster_id');
            $table->unsignedBigInteger('moderator_id');

            $table->foreign('rent_type_id')
            ->references('id')
            ->on('rent_types');
            $table->foreign('area_id')
            ->references('id')
            ->on('areas');
            $table->foreign('poster_id')
            ->references('id')
            ->on('surface_users');
            $table->foreign('moderator_id')
            ->references('id')
            ->on('users');

            $table->timestamps();

            $table->index([
            'id',
            'price',
            'area_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_ads');
    }
};
