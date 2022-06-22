<?php

namespace App\Http\Livewire\Shop;

use App\auction;
use App\Product;
use App\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $updatesQueryString = [
        ['search' => ['except' => '']]
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.shop.index', [
            'products' => $this->search === null ?
                Product::latest()->where('status', 'Telah dilelang')->paginate(8) :
                Product::latest()->where('nama_barang', 'like', '%' . $this->search . '%')->paginate(8)
        ]);
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        Cart::add($product);
        $this->emit('addToCart');
    }

    

    public function ikutLelang($productId)
    {
        $product = Product::find($productId);
        $lelang  = auction::where('id_barang', $product->id_barang)->get()[0];

        bidlist::create([
            'id_peserta'    => Auth::user()->id_user,
            'id_barang'     => $product->id_barang,
            'id_lelang'     => $lelang->id_lelang
        ]);

    }

}
