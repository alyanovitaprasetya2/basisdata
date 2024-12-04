@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-md-6 text-start">
                                <p class="text-uppercase text-sm">Informasi Pengguna</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <a class="btn btn-primary" href="#">Pengaturan</a>
                            </div>
                        </div> --}}
                        {{-- <hr class="horizontal dark"> --}}
                        <div class="col">
                            <p class="text-uppercase text-sm">Ubah Password</p>
                            <form action="">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password Saat Ini</label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password Baru</label>
                                        <input class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Konfirmasi Password</label>
                                        <input class="form-control" type="email">
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm mt-4">Ubah Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="/img/team-2.jpg"
                                        class="rounded-circle img-fluid border border-2 border-white">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="text-center mt-4">
                            <h5 class="mb-0">
                                {{ $data->username }}
                            </h5>
                            <div class="h6">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ $data->email }}
                            </div>
                            <div class="h6 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{ accessTypes($data->role) }}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{ session('tempat_nama') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
