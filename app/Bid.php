<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model 
{

    protected $table = 'bids';
    public $timestamps = true;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('User', 'userId');
    }

    public function auction()
    {
        return $this->belongsTo('Auction', 'auctionId');
    }

}