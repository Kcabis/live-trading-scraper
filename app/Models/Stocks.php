<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;
    protected $fillable = [
        'portfolio_id',
        'stock_name',
        'type',
        'purchase_price',
        'quantity',
        'total_amount',
        'sebon_commission',
        'broker_commission',
        'dp_fee',
        'wacc',
        'total_cost',
    ];


    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
