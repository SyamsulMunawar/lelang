<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga awal</th> 
                                <th>Tanggal lelang</th> 
                                <th>Waktu lelang</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bidlist as $bid)
                                <tr>
                                    <td>{{ $bid->bidlist->nama_barang }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
