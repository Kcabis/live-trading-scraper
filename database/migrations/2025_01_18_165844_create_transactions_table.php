<?php
// In the generated migration file for the 'transaction' table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id'); // Reference to the portfolio
            $table->string('stock_name'); // Name of the stock
            $table->string('action'); // 'buy' or 'sell'
            $table->string('type');
            $table->integer('quantity'); // Quantity of stocks bought or sold
            $table->decimal('price', 10, 2); // Price per stock (buying or selling price)
            $table->decimal('total_amount', 15, 2); // Total amount of the transaction (quantity * price)
            $table->decimal('cgt', 15, 2)->nullable(); // Capital Gain Tax (for sell actions)
            $table->decimal('sebon_commission', 10, 2)->nullable(); // SEBON commission
            $table->decimal('broker_commission', 10, 2)->nullable(); // Broker commission
            $table->decimal('dp_fee', 10, 2)->nullable(); // DP fee
            $table->decimal('wacc', 10, 2)->nullable(); // Weighted Average Cost of Capital (for calculating profit/loss)
            $table->decimal('total_cost', 15, 2)->nullable(); // Total cost of the stock (for calculating profit/loss)
            $table->decimal('profit_loss');
            $table->decimal('net_receivable', 15, 2)->nullable(); // Net receivable (for sell actions)
            $table->timestamps();

            // Add foreign key constraint to link portfolio_id to the portfolios table (if exists)
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
