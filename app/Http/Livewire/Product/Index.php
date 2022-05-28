<?php
namespace App\Http\Livewire\Component;
namespace App\Http\Livewire\Product;

use App\auction;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $paginate = 4;
    public $search;
    public $formVisible;
    public $formUpdate = false;

    protected $listeners = [
        'formClose'         => 'formCloseHandler',
        'productStored'      => 'productStoredHandler',
        'productUpdated'    => 'productUpdatedHandler'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        $id_pelelang = Auth::user()->id_user;

        return view('livewire.product.index',[
            'products' => $this->search === null ?
            Product::latest()->where('id_pelelang', $id_pelelang)->paginate($this->paginate) :
            Product::latest()->where('id_pelelang', $id_pelelang)->where('nama_barang', 'like', '%' . $this->search . '%')
            ->paginate($this->paginate)
        ]);
    }

    public function formCloseHandler()
    {
        $this->formVisible = false;
    }

    public function productStoredHandler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your Product was stored');
    }

    public function editProduct($productId)
    {
        $this->formUpdate = true;
        $this->formVisible = true;
        $product = Product::find($productId);
        $this->emit('editProduct', $product);
    }

    public function productUpdatedHandler()
    {
        $this->formVisible = false;
        session()->flash('message', 'Your product was updated');
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        if($product->image)
        {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        session()->flash('message', 'Product was deleted');
    }
    
    public function ubahStatus($productId)
    {
        $product = Product::find($productId);

        $id = auction::max('id');
        $id_lelang    = '';

        if($id == null){
            $id_lelang = 'L00001';

        }
        elseif($id !== null)
        {
            $jumlah_karakter_id = strlen($id);
            

            for($jumlah_karakter_id; $jumlah_karakter_id < 5; $jumlah_karakter_id++)
            {
                $id_lelang .= '0';
            }
            $id++;
            $id_lelang .= $id;
            $id_lelang = 'L' . $id_lelang;


        }

        auction::create([
            'id_lelang'         =>$id_lelang,
            'id_barang'         =>$product->id_barang,
            'waktu_buka_lelang' =>now(),
            'waktu_tutup_lelang'=>now(),
            'status'            =>'menunggu'
            
        ]);

        $product->update([
            'status'    => 'Telah Dilelang'
        ]);
        
        session()->flash('message', 'Barang berhasil dilelang');
    }

}
