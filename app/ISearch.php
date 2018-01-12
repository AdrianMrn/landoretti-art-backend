<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ISearch extends Model 
{

    protected $table = 'iSearches';
    public $timestamps = true;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('User', 'userId');
    }

}