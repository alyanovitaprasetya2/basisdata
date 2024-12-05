@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Manajemen Meja'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card pb-4">
                <div class="card-header pb-3 d-flex align-items-center justify-content-between">
                    <h5>Manajemen Meja</h5>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card w-25 border-1 border-secondary">
                        <div class="card-body p-3">
                           <div class="row">
                                <div class="col-md-1">
                                    <div class="text-danger">
                                        @include('layouts.icons.badge')
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h6 class="m-0 text-dark">Dipakai</h6>
                                </div>
                            </div> 
                           <div class="row">
                                <div class="col-md-1">
                                    <div class="text-gray">
                                        @include('layouts.icons.badge')
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h6 class="m-0 text-dark">Kosong</h6>
                                </div>
                            </div> 
                           <div class="row">
                                <div class="col-md-1">
                                    <div class="text-warning">
                                        @include('layouts.icons.badge')
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h6 class="m-0 text-dark">Diperbaiki / Dibersihkan</h6>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="row gx-5">
                        @foreach ($meja as $m)
                        <div class="col-md-3 mt-5">
                            <div class="card shadow-sm position-relative">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6>{{ $m->meja }}</h6>
                                            <div class="d-flex align-items-center">
                                                <div class="
                                                    @if($m->is_active == 1) text-gray
                                                    @elseif($m->is_active == 2) text-danger
                                                    @elseif($m->is_active == 3) text-warning
                                                    @endif">
                                                    @include('layouts.icons.badge')
                                                </div>
                                                <p class="ms-2 m-0 fw-bold">{{ statusMeja($m->is_active) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex flex-column-reverse">
                                            <form action="{{ route('meja.update', ['id' => $m->id]) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="status" value="{{ $m->is_active }}">
                                                <button type="submit" class="btn 
                                                    @if($m->is_active == 1) btn-gray
                                                    @elseif($m->is_active == 2) btn-danger
                                                    @elseif($m->is_active == 3) btn-warning
                                                    @endif m-0">
                                                    @if($m->is_active == 1) Gunakan
                                                    @elseif($m->is_active == 2) Kosongkan
                                                    @elseif($m->is_active == 3) Perbaiki
                                                    @endif
                                                </button>
                                            </form>
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