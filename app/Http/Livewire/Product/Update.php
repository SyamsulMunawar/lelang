<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Update extends Component
{

    use WithFileUploads;

    public $productId;
    public $nama_barang;
    public $kategori;
    public $ukuran;
    public $harga_awal;
    public $deskripsi;
    public $image;
    public $imageOld;




    protected $listeners = [
        'editProduct'   => 'editProductHandler'
    ];

    public function render()
    {
        return view('livewire.product.update');
    }

    public function editProductHandler($product)
    {
        $this->productId    = $product['id'];
        $this->nama_barang  = $product['nama_barang'];
        $this->kategori     = $product['kategori'];
        $this->ukuran       = $product['ukuran'];
        $this->harga_awal   = $product['harga_awal'];
        $this->deskripsi    = $product['deskripsi'];
        $this->imageOld     = asset('/storage/'.$product['image']);

    }

    public function update()
    {
        $this->validate([
            'nama_barang'       => 'required:max:50',
            'kategori'          => 'required',
            'ukuran'            => 'required',
            'image'             => 'image|max:2048',
            'harga_awal'        => 'required|numeric',
            'deskripsi'         => 'required|max:180'
        ]);

        if($this->productId)
        {
            $product = Product::find($this->productId);

            $image = '';
            if($this->image)
            {
                Storage::disk('public')->delete($product->image);

                $imageName = Str::slug($this->nama_barang, '-')
                . '-'
                . uniqid()
                . '-' . $this->image->getClientOriginalExtension();

                $this->image->storeAs('public', $imageName, 'local');

                $image = $imageName;

            } else {
                $image = $product->image;
            }

            $product->update([
                'nama_barang'   => $this->nama_barang,
                'kategori'      => $this->kategori,
                'ukuran'        => $this->ukuran,
                'harga_awal'    => $this->harga_awal,
                'deskripsi'     => $this->deskripsi,
                'image'         => $image
            ]);

            $this->emit('productUpdated');
        }
    }

}
