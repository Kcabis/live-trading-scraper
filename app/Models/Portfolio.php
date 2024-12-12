<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    // Allow mass assignment for these fields
    protected $fillable = ['portfolio_name'];



    public function stocks()
    {
        return $this->hasMany(Stocks::class);
    }
}



