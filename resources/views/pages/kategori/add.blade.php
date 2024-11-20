@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kategori Produk'])
    <div class="row mt-4 mx-4">
        <div class="col-md-7">
            <div class="card pb-1">
                <div class="card-header d-flex justify-content-between pb-3">
                    <h5>Tambah Kategori Produk</h5>
                    <a class="btn btn-outline-primary" href="{{ route('kategori') }}">Kembali</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('doCreate') }}" method="POST">
                        @csrf
                        <label for="nama"><p class="fw-bolder m-0 fs-5">Nama Kategori</p></label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Kategori..." required>
                        @error('nama')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection