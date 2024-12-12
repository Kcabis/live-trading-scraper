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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('stock_name');
            $table->string('type');
            $table->decimal('purchase_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('sebon_commission', 10, 2);
            $table->decimal('broker_commission', 10, 2);
            $table->decimal('dp_fee', 10, 2);
            $table->decimal('wacc', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
