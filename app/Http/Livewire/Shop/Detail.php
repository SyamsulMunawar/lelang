<?php

namespace App\Http\Livewire\Shop;

use App\Product;
use Livewire\Component;

class Detail extends Component
{
    // public $barang;

    // public function mount($id_barang){
    //     $barang = Product::find($id_barang);
    // }
    public function render()
    {
        return view('livewire.shop.detail');
    }
}
