@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Pegawai'])
    <div class="row mt-4 mx-4">
        <div class="col-6">
            <div class="card mb-4 px-4">
                <div class="card-header px-0 d-flex justify-content-between pb-0">
                    <h6>Tambah Pegawai</h6>
                    <a href="{{ route('pegawai') }}" class="btn btn-outline-primary">Kembali</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('pegawai.doCreate') }}" method="POST">
                                @csrf
                                <label for="nama"><p class="fw-bold m-0">Nama Pegawai</p></label>
                                <input class="form-control mb-3" type="text" name="nama" id="nama" placeholder="Tambah Pegawai..." required>            
                                <label for="email"><p class="fw-bold m-0">Email</p></label>
                                <input class="form-control mb-3" type="email" name="email" id="email" placeholder="Email" required>            
                                <label for="password"><p class="fw-bold m-0">Password</p></label>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>            
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
