<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Auction;

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

    public function watchlistItems()
    {
        $itemIds = $this->hasMany('App\WatchlistItem', 'userId')->get();
        $watchlistItems = [];
        foreach ($itemIds as $item)
        {
            array_push($watchlistItems, Auction::where('id', $item->auctionId)->first());
        }
        return $watchlistItems;
    }
}
