<div class="container">

    @if($formVisible)
        @if (! $formUpdate)
            @livewire('product.create')
        @else
            @livewire('product.update')
        @endif
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Products
                    <button wire:click="$toggle('formVisible')" class="btn btn-sm btn-primary">Create</button>
                </div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <select wire:model="paginate" name="" id="" class="form-control form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control form-control-sm" placeholder="Search...">
                        </div>
                        <hr>
                    </div>

                     <table class="table">
                         <thead class="thead-dark">
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Nama Barang</th>
                                 <th scope="col">Kategori</th>
                                 <th scope="col">Ukuran</th>
                                 <th scope="col">Gambar</th>
                                 <th scope="col">Harga Awal</th>
                                 <th scope="col">Deskripsi</th>
                                 <th scope="col">Status Barang</th>
                                 <th scope="col">Jadwal Lelang</th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no=0?>
                             @foreach($products as $product)
                                <?php $no++ ?>
                                <tr>
                                    <td scope="row">{{ $no }}</td>
                                    <td scope="col">{{ $product->nama_barang }}</td>
                                    <td scope="col">{{ $product->kategori }}</td>
                                    <td scope="col">{{ $product->ukuran }}</td>
                                    <td scope="col">
                                        <img src="{{ asset('/storage/'.$product->image) }}" alt="" height="80">
                                    </td>
                                    <td scope="col">Rp{{ number_format($product->harga_awal,2,",",".") }}</td>
                                    <td scope="col">{{ $product->deskripsi }}</td>
                                    <td scope="col">{{ $product->status }}</td>
                                    <td scope="col"></td>
                                    <td>
                                        <button wire:click="editProduct({{ $product->id }})" class="btn btn-sm btn-info">Edit</button>
                                        <button wire:click="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger">Hapus</button>
                                        @if($product->status == 'Belum dilelang')
                                            <button wire:click="ubahStatus({{ $product->id }})" class="btn btn-sm btn-success">Lelang barang</button>
                                        @endif
                                    </td>
                                </tr>
                             @endforeach
                         </tbody>
                     </table>
                     {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>