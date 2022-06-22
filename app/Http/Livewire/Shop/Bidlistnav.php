<?php

namespace App\Http\Livewire\Shop;

use App\bidlist;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Bidlistnav extends Component
{
    public $bidlistTotal = 0;

    public function render()
    {
        $this->bidlistTotal = bidlist::where('id_peserta', Auth::user()->id_user)->count('id_peserta');
        return view('livewire.shop.bidlistnav');
    }
}
