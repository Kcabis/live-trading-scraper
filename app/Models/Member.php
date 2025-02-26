<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable implements MustVerifyEmail 
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function otp()
    {
        return $this->hasOne(Otp::class);
    }
   public function portfolios()
   {
       return $this->hasMany(Portfolio::class);
   }
}
