<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ISearch extends Model 
{

    protected $table = 'iSearches';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('User', 'userId');
    }

}