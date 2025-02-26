<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [ 'member_id','portfolio_name'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }



    public function stocks()
    {
        return $this->hasMany(Stocks::class,'portfolio_id');
    }
}



