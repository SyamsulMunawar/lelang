<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bidlist extends Model
{
    protected $table = 'bidlists';
    protected $guarded = ['id'];

    // public function product()
    // {
    //     return $this->hasMany('App\Product');
    // }

}
