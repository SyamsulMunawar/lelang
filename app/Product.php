<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded = ['id'];

    public function bidlist()
    {
        return $this->bolongsTo('App\bidlist');
    }
}
