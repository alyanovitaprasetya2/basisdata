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
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless">
                                    <thead>
                                      <tr>
                                        <th width="30%" class="fw-normal ps-3 pe-0 fs-5">Menu</th>
                                        <th class="fw-normal text-center px-0 fs-5">Jumlah</th>
                                        <th class="fw-normal text-center px-0 fs-5">Subtotal</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><p class="fs-4 fw-bold text-dark my-2">Lalapan Lele</p></td>
                                        <td><p class="fs-4 fw-bold text-dark my-2 text-center">6</p></td>
                                        <td><p class="fs-4 fw-bold text-dark my-2 text-center">Rp30.000</p></td>
                                      </tr>
                                      <tr>
                                        <td><p class="fs-4 fw-bold text-dark my-1">Es Teh</p></td>
                                        <td><p class="fs-4 fw-bold text-dark my-1 text-center">6</p></td>
                                        <td><p class="fs-4 fw-bold text-dark my-1 text-center">Rp16.000</p></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <div class="mt-5">
                                    <label for="" class="fs-5 mb-0 fw-normal">Total</label>
                                    <p class="fs-4 fw-bold text-dark">Rp46.000</p>
                                  </div>
                                  <hr class="dotted my-4">
                            </div>

                            <div class="col-md-6">
                                <label for="" class="m-0 fw-normal fs-5">Tanggal Penjualan</label>
                                <p class="fs-5 fw-bold text-dark">Jumat, 29 November 2024</p>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="m-0 fw-normal fs-5">Pegawai</label>
                                <p class="fs-5 fw-bold text-dark">Paska Gaming</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="fw-medium letter-spacing-1">AKSI</p>
                        <a class="btn btn-primary m-0">Print<span class="ms-2">@include('layouts.icons.print')</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection