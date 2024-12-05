@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kategori Produk'])
    <div class="row mt-4 mx-4">
        <div class="col-md-7">
            <div class="card pb-4">
                <div class="card-header d-flex justify-content-between pb-3">
                    <h5>Kategori Produk</h5>
                    <a class="btn btn-primary" href="{{ route('add') }}">Tambah Kategori</a>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card d-none border-1 border-secondary">
                        <div class="card-body p-3">
                            <form class="row px-2" action="GET">
                                <div class="col-md-auto">
                                    <label class="visually-hidden" for="category_filter">Kategori</label>
                                    <select class="form-select pe-5" name="category_filter" id="">
                                        <option value="">Semua Kategori</option>
                                        <option value="">Minuman</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class="table table-bordered align-items-center mb-0 mt-5">
                        <thead>
                            <tr class="table-light">
                                <th width="5%" class="text-uppercase text-center font-weight-bolder">ID</th>
                                <th class="text-uppercase ps-2">Kategori</th>
                                <th width="10%" class="text-uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $c)
                            <tr>
                                <td>
                                    <p class="mb-0 text-center">{{ $c->id }}</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold mb-0">{{ $c->nama }}</p>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" class="font-weight-bold"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection