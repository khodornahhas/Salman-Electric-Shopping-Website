<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Make sure the column type matches the id type in promocodes table
            $table->foreignId('promocode_id')
                ->nullable()
                ->constrained('promocodes') // use the correct table name
                ->nullOnDelete(); // if promo deleted, set null
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['promocode_id']);
            $table->dropColumn('promocode_id');
        });
    }
};
