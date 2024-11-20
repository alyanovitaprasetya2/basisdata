@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Penjualan'])
    <div class="row mt-4 mx-4">
        <div class="col-9">
            <div class="card pb-4">
                <div class="card-header pb-3 d-flex align-items-center justify-content-between">
                    <h5>Penjualan</h5>
                    <a class="btn m-0 btn-primary" href="{{ route('produk.add') }}">Tambah Produk</a>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card border-1 border-secondary">
                        <div class="card-body p-3">
                            <form class="row px-2" action="GET">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3" placeholder="Nama Produk">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3" placeholder="Kata Kunci Produk">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row gx-5">
                        @foreach ($produk as $p)
                        <div class="col-md-3 mt-5">
                            <div class="card shadow-sm position-relative" style="overflow: hidden">
                                <div class="price-label d-flex align-items-center justify-content-center">
                                    <h4 class="text-light fw-bolder m-0">{{ formatRupiah($p->Price) }}</h4>
                                </div>
                                <div class="card-body p-3">
                                    <div class="text-center">
                                        <img src="{{ Storage::url($p->image_path) }}" class="rounded-3 img-cover">
                                    </div>
                                    <div class="body pt-3">
                                        <h5 class="fw-bold text-dark mb-2">{{ $p->NamaProduk }}</h5>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center pe-3">
                                                @include('layouts.icons.star')
                                                <p class="m-0 ps-1 fw-bold">-</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                @include('layouts.icons.item')
                                                <p class="m-0 ps-1">{{ $p->Stok }} item</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <div class="trx-label d-flex align-items-center justify-content-center">
                        <h5 class="m-0 text-light fw-bolder">Penjualan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between">
                                    <p class="m-0 fw-bold">Nama Makanan</p>
                                    <p class="m-0 fw-bold">2</p>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="m-0">Nama Makanan</p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <p class="m-0">Nama Makanan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection