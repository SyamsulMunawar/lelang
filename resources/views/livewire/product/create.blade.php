<div class="row justify-content-center mb-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store" method="POST" enctype="multipart/form-data">
                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                              <input wire:model="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Nama barang">
                              @error('nama_barang')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="col">
                                <select wire:model="kategori" class="form-control @error('kategori') is-invalid @enderror" id="kategori">
                                    <option value="">Pilih Kategori Pakaian</option>
                                    <option value="Kemeja">Kemeja</option>
                                    <option value="Kaos">Kaos</option>
                                    <option value="Celana Panjang">Celana Panjang</option>
                                    <option value="Celana Pendek">Celana Pendek</option>
                                    <option value="Rok">Rok</option>
                                    <option value="Topi">Topi</option>
                                    <option value="Hijab">Hijab</option>
                                    <option value="Jaket">Jaket</option>
                                    <option value="Sweater">Sweater</option>
                                    <option value="Sepatu/Sandal">Sepatu/Sandal</option>
                                </select>
                                @error('kategori')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                              <input wire:model="ukuran" type="text" class="form-control @error('ukuran') is-invalid @enderror" placeholder="Ukuran">
                              @error('ukuran')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="col">
                              <input wire:model="harga_awal" type="text" class="form-control @error('harga_awal') is-invalid @enderror" placeholder="Harga awal">
                              @error('harga_awal')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                                <textarea wire:model="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="71" rows="5" placeholder="Deskripsi"></textarea>  
                                @error('deskripsi')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                     <div class="form-group">

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <input wire:model="image" type="file" class="form-control-file" id="image">
                                    
                                    @error('image')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="" height="200">
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                

                    <div class="btn-group" role="group" aria-label="Button Form">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <button wire:click="$emit('formClose')" type="button" class="btn btn-sm btn-secondary">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>