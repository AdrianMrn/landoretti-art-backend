<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'country', 'zipcode', 'city', 'address', 'phone', 'accountnumber', 'vatnumber'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function auctions()
    {
        return $this->hasMany('Auction');
    }

    public function bids()
    {
        return $this->hasMany('Bid');
    }

    public function searches()
    {
        return $this->hasMany('ISearch');
    }
}
