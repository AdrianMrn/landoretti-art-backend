<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Auction extends Model 
{

    protected $table = 'auctions';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo('User', 'userId');
    }

    public function amountOfBids()
    {
        return $this->hasMany('App\Bid', 'auctionId')->count();
    }

    public function highestBidAmount()
    {
        return Bid::where('auctionId', $this->id)->max('amount');
    }

    public function bids()
    {
        return $this->hasMany('Bid');
    }

    public function timeleft()
    {
        $endTime = strtotime($this->endDate);
        $currTime = Carbon::now()->timestamp;

        $timeToEnd = $endTime - $currTime;

        $m = floor(($timeToEnd%3600)/60);
        $h = floor(($timeToEnd%86400)/3600);
        $d = floor(($timeToEnd%2592000)/86400);

        return $d . 'd ' . $h . 'h ' . $m . 'm';
    }

    public function isActive()
    {
        if ($this->status == 'active')
        {
            return true;
        } else {
            return false;
        }
    }

}