<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',  
        'portfolio_data'
    ];

    // Automatically cast portfolio_data to an array when retrieved
    protected $casts = [
        'portfolio_data' => 'array', // This will make sure the portfolio_data is treated as an array when fetched
    ];
}
