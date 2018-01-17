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
    public function auctionWinner()
    {
        $highestBid = $this->hasMany('App\Bid', 'auctionId')->max('amount');
        $winningBid = $this->hasMany('App\Bid', 'auctionId')->where('amount', $highestBid)->first();
        return $winningBid;
    }
    public function auctionParticipants()
    {
        $allBids = $this->hasMany('App\Bid', 'auctionId')->get();
        return $allBids;
    }

    public function timeleft()
    {
        $endTime = strtotime($this->endDate);
        $currTime = Carbon::now()->timestamp;

        $timeToEnd = $endTime - $currTime;

        if ($timeToEnd < 0)
        {
            return $this->status;
        }

        $m = floor(($timeToEnd%3600)/60);
        $h = floor(($timeToEnd%86400)/3600);
        $d = floor(($timeToEnd%2592000)/86400);

        return $d . 'd ' . $h . 'h ' . $m . 'm';
    }

    public function isActive()
    {
        if ($this->status == 'active' && strtotime($this->endDate) > Carbon::now()->timestamp)
        {
            return true;
        } else {
            return false;
        }
    }

    public function endDateFormatted()
    {
        return date('l jS \of F Y h:i:s A', strtotime($this->endDate));
    }

    public function estimatedPrice()
    {
        return (($this->priceMinEst + $this->priceMaxEst)/2);
    }
}