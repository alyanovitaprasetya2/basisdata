@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Pelanggan'])
    <div class="row mt-4 mx-4">
        <div class="col-6">
            <div class="card mb-4 px-4">
                <div class="card-header px-0 d-flex justify-content-between pb-0">
                    <h6>Tambah Pelanggan</h6>
                    <a href="{{ route('pelanggan') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pelanggan.doCreate') }}" method="POST">
                                @csrf
                                <label for="nama"><p class="fw-bold m-0">Nama Pelanggan</p></label>
                                <input class="form-control mb-3" type="text" name="nama" id="nama" placeholder="Pelanggan..." required>            
                                <label for="email"><p class="fw-bold m-0">Nomor Telepon</p></label>
                                <input class="form-control mb-3" type="text" name="nomor" id="email" placeholder="Nomor Telepon..." required>            
                                <label for="password"><p class="fw-bold m-0">Alamat</p></label>
                                <textarea class="form-control" name="alamat" cols="10"></textarea>           
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
