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
    Schema::table('users', function (Blueprint $table) {
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('mobile')->unique()->nullable();
        $table->boolean('is_verified')->default(false);
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['first_name', 'last_name', 'mobile', 'is_verified']);
    });
}
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('otp')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('otp');
    });
}


};