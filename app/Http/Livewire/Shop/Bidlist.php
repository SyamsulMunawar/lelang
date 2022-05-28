<?php

namespace App\Http\Livewire\Shop;

use App\bidlist as AppBidlist;
use Livewire\Component;

class Bidlist extends Component
{
    public function mount()
    {

    }
    public function render()
    {
        $bidlist = AppBidlist::all()[0];
        
        return view('livewire.shop.bidlist',[
            'bidlist'   => $bidlist
        ]);
    }
}
