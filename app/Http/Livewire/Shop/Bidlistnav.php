<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class Bidlistnav extends Component
{
    public $bidlistTotal = 2;
    public function render()
    {
        return view('livewire.shop.bidlistnav');
    }
}
