<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchlistItem extends Model 
{

    protected $table = 'watchlistItems';
    public $timestamps = true;

    protected $guarded = ['id'];

}