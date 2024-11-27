@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Penjualan'])
    <div class="row mt-4 mx-4">
        <div class="col-9">
            <div class="card pb-4">
                <div class="card-header pb-3 d-flex align-items-center justify-content-between">
                    <h5>Penjualan</h5>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card border-1 border-secondary">
                        <div class="card-body p-3">
                            <form class="row px-2" action="GET">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Nama Produk">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Kata Kunci Produk">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row gx-5">
                        @foreach ($produk as $p)
                        <div class="col-md-3 mt-5">
                            <button class="card card-hover position-relative tambah-pesanan" 
                                    data-id="{{ $p->id }}" 
                                    data-nama="{{ $p->NamaProduk }}"
                                    data-price="{{ $p->Price }}"
                                    style="border: none; background: none; padding: 0; cursor: pointer; overflow: hidden;">
                                <div class="price-label d-flex align-items-center justify-content-center">
                                    <h4 class="text-light fw-bolder m-0">{{ formatRupiah($p->Price) }}</h4>
                                </div>
                                <div class="card-body p-3">
                                    <div class="text-center">
                                        <img src="{{ Storage::url($p->image_path) }}" class="rounded-3 img-cover">
                                    </div>
                                    <div class="body pt-3">
                                        <h5 class="fw-bold text-start text-dark mb-2">{{ $p->NamaProduk }}</h5>
                                    </div>
                                </div>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card overflow-hidden position-fixed" style="height: 85vh; right: 20; width: 20%">
                <div class="card-header">
                    <div class="trx-label d-flex align-items-center justify-content-center">
                        <h5 class="m-0 text-white fw-bolder">Pesanan</h5>
                    </div>
                </div>
                <div class="card-body" data-bs-spy="scroll" data-bs-smooth-scroll="true">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="list-pesanan overflow-auto" style="max-height: 550px;"></div>
                        </div>
                    </div>
                </div>
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="wrapper d-flex justify-content-between">
                            <h5 class="text-white">Total</h5>
                            <h5 class="text-white total-harga">Rp0</h5>
                        </div>
                        <a href="#" class="btn btn-primary btn-lg fs-5 m-0 mt-3 w-100">Konfirmasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const pesanan = {};
        let totalHarga = 0;

        function formatRupiah(angka) {
            return `Rp${angka.toLocaleString('id-ID')}`;
        }

        document.querySelectorAll(".tambah-pesanan").forEach(card => {
            card.addEventListener("click", function () {
                const produkId = this.dataset.id;
                const namaProduk = this.dataset.nama;
                const hargaProduk = parseFloat(this.dataset.price);

                totalHarga += hargaProduk;

                if (pesanan[produkId]) {
                    pesanan[produkId].jumlah += 1;
                } else {
                    pesanan[produkId] = { nama: namaProduk, jumlah: 1, harga: hargaProduk };
                }

                updatePesanan();
                const totalHargaElement = document.querySelector(".total-harga");
                if (totalHargaElement) {
                    totalHargaElement.textContent = formatRupiah(totalHarga);
                }
            });
        });

        function updatePesanan() {
            const listPesanan = document.querySelector(".list-pesanan");
            if (!listPesanan) return; 

            listPesanan.innerHTML = "<h5 class='fw-bold'>Pesanan:</h5>";

            for (const id in pesanan) {
                const item = pesanan[id];
                const card = document.createElement("div");
                card.className = "card mb-3";
                card.innerHTML = `
                    <div class="card-body d-flex justify-content-between">
                        <p class="m-0 fw-bold">${item.nama}</p>
                        <p class="m-0 fw-bold">${item.jumlah} x ${formatRupiah(item.harga)}</p>
                    </div>
                `;
                listPesanan.appendChild(card);
            }
        }
    });
    </script>
    
@endsection