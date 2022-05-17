<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart['products'] as $product)
                            <tr>
                                <td>{{ $product->nama_barang }}</td>
                                <td>Rp{{ number_format($product->harga,2,",",".") }}</td>
                                <td>
                                    <button wire:click="removeFromCart({{ $product->id }})" class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <a href="{{ route('shop.checkout') }}" class="btn btn-primary float-right">Checkout</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
