@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Rekap Penjualan'])
    <div class="row mt-4 mx-4">
        <div class="col-7">
            <div class="card mb-4 px-4">
                <div class="card-header px-0 d-flex align-items-center justify-content-between pb-0">
                    <h6 class="m-0 fs-5">Rekap Penjualan</h6>
                    <form action="{{ route('exportExcel') }}">
                        <button type="submit" class="btn btn-success m-0">Download Excel</button>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <table class="table table-bordered align-items-center mb-0 mt-5">
                        <thead>
                            <tr class="table-light">
                                <th width="5%" class="text-uppercase text-center font-weight-bolder">ID</th>
                                <th width="20%" class="text-uppercase ps-2">Kode</th>
                                <th class="text-uppercase ps-2">Tanggal Penjualan</th>
                                <th width="18%" class="text-uppercase ps-2">Total Harga</th>
                                <th width="10%" class="text-uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>
                                    <p class="mb-0 text-center">{{ $d->id }}</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold mb-0">{{ $d->Kode }}</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold mb-0">{{ formatTanggal($d->TanggalPenjualan) }}</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold mb-0">{{ formatRupiah($d->TotalHarga) }}</p>
                                </td>
                                <td>
                                    <a href="{{ route('rekap.detail', ['id' => $d->id]) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $data->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    @if (!count($data))
                        <div class="text-center my-5">
                            <h5>Data Belum Tersedia😱</h5>
                            <p>Silahkan tambah data terlebih dahulu</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection