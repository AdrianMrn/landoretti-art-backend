<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model 
{

    protected $table = 'auctionImages';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function auction()
    {
        return $this->belongsTo('Auction', 'auctionId');
    }

}