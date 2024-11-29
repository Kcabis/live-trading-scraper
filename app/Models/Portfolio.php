<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'portfolios';

    // Allow mass assignment for these fields
    protected $fillable = ['shareholder_name'];
}
