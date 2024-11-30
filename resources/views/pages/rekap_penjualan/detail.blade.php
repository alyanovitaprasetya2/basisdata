@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail Penjualan'])
    <div class="row mx-4">
        <div class="col-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0">Detail <b>Penjualan</b></h5>
                        <a href="{{ route('rekap') }}" class="btn btn-outline-primary m-0 btn-sm">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
   

        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless">
                                    <thead>
                                      <tr>
                                        <th width="30%" class="fw-normal ps-3 pe-0 fs-5">Menu</th>
                                        <th class="fw-normal text-center px-0 fs-5">Jumlah</th>
                                        <th class="fw-normal text-center px-0 fs-5">Harga</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $d)
                                        <tr>
                                            <td><p class="fs-4 fw-bold text-dark my-2">{{ $d->produk->NamaProduk }}</p></td>
                                            <td><p class="fs-4 fw-bold text-dark my-2 text-center">{{ $d->JumlahProduk }}</p></td>
                                            <td><p class="fs-4 fw-bold text-dark my-2 text-center">{{ formatRupiah($d->produk->Price) }}</p></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                                  <div class="mt-5">
                                    <label for="" class="fs-5 mb-0 fw-normal">Total</label>
                                    <p class="fs-4 fw-bold text-dark">{{ formatRupiah($penjualan->TotalHarga) }}</p>
                                  </div>
                                  <hr class="dotted my-4">
                            </div>

                            <div class="col-md-6">
                                <label for="" class="m-0 fw-normal fs-5">Tanggal Penjualan</label>
                                <p class="fs-5 fw-bold text-dark">{{ formatedDate($penjualan->TanggalPenjualan) }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="m-0 fw-normal fs-5">Dicatat Oleh</label>
                                <p class="fs-5 fw-bold text-dark">{{ $penjualan->user->username }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="fw-medium letter-spacing-1">AKSI</p>
                        <a href="{{ route('nota', ['id' => $detail->first()->id]) }}" class="btn btn-primary m-0">Print<span class="ms-2">@include('layouts.icons.print')</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection