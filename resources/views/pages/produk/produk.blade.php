@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manajemen Produk'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card pb-4">
                <div class="card-header pb-3 d-flex align-items-center justify-content-between">
                    <h5>Produk</h5>
                    <a class="btn m-0 btn-primary" href="{{ route('produk.add') }}">Tambah Produk</a>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card border-1 d-none border-secondary">
                        <div class="card-body p-3">
                            <form class="row px-2" action="GET">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3" placeholder="Nama Produk">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mb-3" placeholder="Kata Kunci Produk">
                                </div>
                                <div class="col-md-auto">
                                    <label class="visually-hidden" for="category_filter">Kategori</label>
                                    <select class="form-select pe-5" name="category_filter" id="">
                                        <option value="">Semua Kategori</option>
                                        <option value="">Minuman</option>
                                        <option value="">Makanan</option>
                                        <option value="">Gorengan</option>
                                    </select>
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
                                            <div class="dropdown ms-auto">
                                                <button type="button" data-bs-toggle="dropdown" class="bg-transparent border-0" aria-expanded="false">
                                                    @include('layouts.icons.dehaze')
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item text-success" href="{{ route('produk.update', ['id' => $p->id]) }}">Edit</a></li>
                                                    <form action="{{ route('produk.delete', ['id' => $p->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li><button class="dropdown-item text-danger" type="submit">Hapus</button></li>
                                                    </form>
                                                </ul>
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
    </div>
@endsection