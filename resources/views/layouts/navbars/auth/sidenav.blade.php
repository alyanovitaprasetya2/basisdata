<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main" style="z-index: 5">
    <div class="sidenav-header">
        <a class="navbar-brand d-flex justify-content-center h-100 align-items-center p-1 m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="{{ asset('assets/logo/cashier.png') }}" class="navbar-brand-img" style="width: 120px;" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::ADMINISTRATOR)
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active text-primary' : '' }}" href="{{ route('home') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.dashboard')
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
                @endif
            </li>
            {{-- somes --}}
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::SUPER_ADMIN)
                <a class="nav-link {{ Route::currentRouteName() == 'tempat' ? 'active text-primary' : '' }}" href="{{ route('tempat') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.tempat')
                    </div>
                    <span class="nav-link-text ms-1">Tempat</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::SUPER_ADMIN)
                <a class="nav-link {{ Route::currentRouteName() == 'users' ? 'active text-primary' : '' }}" href="{{ route('users') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.users')
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PEGAWAI)
                <a class="nav-link {{ Route::currentRouteName() == 'penjualan' ? 'active text-primary' : '' }}" href="{{ route('penjualan') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.transaction')
                    </div>
                    <span class="nav-link-text ms-1">Penjualan</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PEGAWAI)
                <a class="nav-link {{ Route::currentRouteName() == 'meja' ? 'active text-primary' : '' }}" href="{{ route('meja') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.table')
                    </div>
                    <span class="nav-link-text ms-1">Meja</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PENGAWAS || Auth::check() && Auth::user()->role === \App\Entities\UserEntity::ADMINISTRATOR)
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['rekap', 'rekap.detail']) ? 'active text-primary' : '' }}" href="{{ route('rekap') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.rekap')
                    </div>
                    <span class="nav-link-text ms-1">Rekapitulasi</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PEGAWAI)
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['pelanggan', 'rekap.detail']) ? 'active text-primary' : '' }}" href="{{ route('pelanggan') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.member')
                    </div>
                    <span class="nav-link-text ms-1">Member</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PENGAWAS || Auth::check() && Auth::user()->role === \App\Entities\UserEntity::ADMINISTRATOR )
                <a class="nav-link {{ Route::currentRouteName() == 'produk' ? 'active text-primary' : '' }}" href="{{ route('produk') }}">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.product')
                    </div>
                    <span class="nav-link-text ms-1">Produk</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::PENGAWAS)
                <a class="nav-link {{ Route::currentRouteName() == 'kategori' ? 'active text-primary' : '' }}" href="{{ route('kategori') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.category')
                    </div>
                    <span class="nav-link-text ms-1">Kategori</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                @if(Auth::check() && Auth::user()->role === \App\Entities\UserEntity::ADMINISTRATOR)
                <a class="nav-link {{ Route::currentRouteName() == 'pegawai' ? 'active text-primary' : '' }}" href="{{ route('pegawai') }}">
                    @include('layouts.icons.employee')
                    <span class="nav-link-text ms-1">Pegawai</span>
                </a>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active text-primary' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="text-center me-2 d-flex align-items-center justify-content-center">
                        @include('layouts.icons.profile')
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
