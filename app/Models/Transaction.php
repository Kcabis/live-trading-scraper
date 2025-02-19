<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Define the table name (optional if it's the plural form of the model name)
    protected $table = 'transactions';

    // Define the fields that are mass assignable (columns you want to fill using mass-assignment)
    protected $fillable = [
        'portfolio_id', 
        'stock_name',
        'action', 
        'type', 
        'quantity', 
        'price', 
        'total_amount', 
        'cgt', 
        'sebon_commission', 
        'broker_commission', 
        'dp_fee', 
        'wacc', 
        'total_cost', 
        'profit_loss', 
        'net_receivable'
    ];

    // Optional: Define relationships (for example, if a transaction belongs to a portfolio)
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    // Optional: Add custom methods if needed (e.g., for calculating profit/loss)

    /**
     * Calculate profit or loss based on buying and selling price
     */
    public function calculateProfitLoss()
    {
        if ($this->action === 'sell') {
            return $this->total_amount - $this->total_cost; // Assuming total_amount - total_cost gives profit/loss
        }

        return 0;
    }

    // You can define any other helper methods to calculate taxes, net amount, etc., if required.
}
