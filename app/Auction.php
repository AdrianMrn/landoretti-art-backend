<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auction extends Model 
{

    protected $table = 'auctions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function auctionPhotos()
    {
        return $this->hasMany('Photo');
    }

    public function owner()
    {
        return $this->belongsTo('User', 'userId');
    }

    public function bids()
    {
        return $this->hasMany('Bid');
    }

}