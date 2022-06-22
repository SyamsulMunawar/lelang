<?php

namespace App\Http\Livewire\Product;

use App\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $nama_barang;
    public $kategori;
    public $ukuran;
    public $image;
    public $harga_awal;
    public $deskripsi;


    public function render()
    {
        return view('livewire.product.create');
    }

    public function store()
    {
        
        $this->validate([
            'nama_barang'       => 'required:max:50',
            'kategori'          => 'required',
            'ukuran'            => 'required',
            'image'             => 'image|max:2048',
            'harga_awal'        => 'required|numeric',
            'deskripsi'         => 'required|max:180'
        ]);

        $imageName = '';

        if($this->image)
        {
            $imageName = Str::slug($this->nama_barang, '-')
            . '-'
            . uniqid()
            . '-' . $this->image->getClientOriginalExtension();

            $this->image->storeAs('public', $imageName, 'local');
        }

        $id = Product::max('id');
        $id_barang    = '';

        if($id == null){
            $id_barang = 'B00001';
        }
        elseif($id !== null)
        {
            $jumlah_karakter_id = strlen($id);
            

            for($jumlah_karakter_id; $jumlah_karakter_id < 5; $jumlah_karakter_id++)
            {
                $id_barang .= '0';
            }
            $id++;
            $id_barang .= $id;
            $id_barang = 'B' . $id_barang;

        }    
        
        Product::create([
            'id_barang'     => $id_barang,
            'id_pelelang'   => Auth::user()->id_user,
            'nama_barang'   => $this->nama_barang,
            'kategori'      => $this->kategori,
            'ukuran'        => $this->ukuran,
            'image'         => $imageName,
            'harga_awal'    => $this->harga_awal,
            'deskripsi'     => $this->deskripsi,
            'status'        => 'Belum dilelang'
        ]);
        
        $this->emit('productStored');
        
    }
}

              
              
               
                    
                  
                    
            