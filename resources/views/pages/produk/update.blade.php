@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Produk'])
    <div class="row mt-4 mx-4">
        <div class="col-md-7">
            <div class="card pb-1">
                <div class="card-header d-flex justify-content-between pb-3">
                    <h5>Tambah Produk</h5>
                    <a class="btn btn-outline-primary" href="{{ route('produk') }}">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.doUpdate', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="nama"><p class="fw-bold m-0">Nama Produk</p></label>
                        <input type="text" name="nama" class="form-control form-control-lg mb-3 @error('nama') is-invalid @enderror" id="nama" placeholder="Nama Produk" value="{{ old('nama') }}" required>
                        <label for="kategori"><p class="fw-bold m-0">Kategori Produk</p></label>
                        <select class="form-select form-select-lg mb-3 @error('kategori') is-invalid @enderror" name="kategori">
                            <option value="">- Pilih Kategori -</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('kategori') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        <label for="harga"><p class="fw-bold m-0">Harga</p></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="harga_formatted" class="form-control form-control-lg @error('harga') is-invalid @enderror" id="harga" placeholder="Harga" value="{{ old('harga_formatted') }}" required>
                            <input type="hidden" name="harga" id="harga_raw" value="{{ old('harga') }}">
                        </div>
                        <label for="stok"><p class="fw-bold m-0">Stok</p></label>
                        <input type="number" name="stok" class="form-control w-25 form-control-lg mb-3 @error('stok') is-invalid @enderror" id="stok" placeholder="Stok" value="{{ old('stok') }}" required>
                        <label for="image"><p class="fw-bold m-0">Pilih Foto</p> </label>
                        <input type="file" class="form-control form-control-lg mb-3 @error('image') is-invalid @enderror" name="image" id="image" accept="image/*" required>
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

    <script>
        var cleave = new Cleave('#harga', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.', 
            numeralDecimalMark: ',' 
        });

         // Update input hidden setiap kali ada perubahan di input yang diformat
        document.getElementById('harga').addEventListener('input', function () {
            var rawValue = cleave.getRawValue(); // Nilai tanpa format
            document.getElementById('harga_raw').value = rawValue;
        });
    </script>
@endsection