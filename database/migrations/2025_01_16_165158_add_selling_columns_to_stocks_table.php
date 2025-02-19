<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->decimal('selling_price', 15, 2)->nullable();
            $table->integer('sold_quantity')->nullable();
            $table->decimal('profit_loss', 15, 2)->nullable();
            $table->decimal('capital_gain_tax', 15, 2)->nullable();
            $table->decimal('net_receivable', 15, 2)->nullable();
            $table->timestamp('sold_at')->nullable(); // For timestamp of the sale
        });
    }
    
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn(['selling_price', 'sold_quantity', 'profit_loss', 'capital_gain_tax', 'net_receivable', 'sold_at']);
        });
    }
    
};
