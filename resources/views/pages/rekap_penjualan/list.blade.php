@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Rekap Penjualan'])
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endpush
    <div class="row mt-4 mx-4">
        <div class="col-7">
            <div class="card mb-4 px-4">
                <div class="card-header px-0 d-flex align-items-center justify-content-between pb-0">
                    <h6 class="m-0 fs-5">Rekap Penjualan</h6>
                    <form action="{{ route('exportExcel') }}">
                        <button type="submit" class="btn btn-success m-0">Download Excel</button>
                    </form>
                </div>
                <div class="card mt-3 border border-secondary">
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('rekap') }}">
                                <div class="col-md-8">
                                    <div id="reportrange" class="form-control border-gray" style="cursor: pointer; padding: 10px 20px; width: fit-content;">
                                        <span>{{ $daterange ?? '' }}</span>
                                        <input type="hidden" name="daterange" id="daterange">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary mt-3 mb-0" id="btn-filter">Terapkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                                    <a href="{{ route('rekap.detail', ['id' => $d->id]) }}" class="btn btn-sm my-2 btn-outline-primary">Lihat Detail</a>
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>

    <script>
        $(document).ready(function() {
            moment.locale('id')
            
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            }

            $('#reportrange').daterangepicker({
                startDate: moment().startOf('month'),
                endDate: moment(),
                ranges: {
                    'Hari Ini': [moment(), moment()],
                    'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                    '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                    'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
                },
                locale: {
                    format: 'DD MMMM YYYY',
                    separator: ' - ',
                    applyLabel: 'Terapkan',
                    cancelLabel: 'Batal',
                    daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ],
                    firstDay: 1
                }
            }, cb);

            cb(start, end);
        })
    </script>

@endsection