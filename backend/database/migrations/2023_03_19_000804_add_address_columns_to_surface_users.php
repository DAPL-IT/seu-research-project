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
        Schema::table('surface_users', function (Blueprint $table) {
            $table->string('current_address')->after('online')->nullable();
            $table->string('permanent_address')->after('current_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surface_users', function (Blueprint $table) {
            $table->dropColumn('current_address');
            $table->dropColumn('permanent_address');
        });
    }
};
