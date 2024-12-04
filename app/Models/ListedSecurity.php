<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListedSecurity extends Model
{
    use HasFactory;
    protected $fillable=['stock_id','Date','S_ID','symbol','Name'];
}
