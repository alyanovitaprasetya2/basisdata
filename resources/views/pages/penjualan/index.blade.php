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

                    <div class="row gx-2">
                        @foreach ($produk as $p)
                        <div class="col-md-3 mt-5">
                            <button class="card card-hover position-relative tambah-pesanan" 
                                    data-id="{{ $p->id }}" 
                                    data-nama="{{ $p->NamaProduk }}"
                                    data-price="{{ $p->Price }}"
                                    style="border: none; background: none; padding: 0; cursor: pointer; overflow: hidden;">
                                <div class="price-label d-flex align-items-center justify-content-center" style="width: 90px; height:40px" >
                                    <p class="text-light fw-bolder m-0 " style="font-size: 14px">{{ formatRupiah($p->Price) }}</p>
                                </div>
                                <div class="card-body p-3">
                                    <div class="text-center">
                                        <img src="{{ Storage::url($p->image_path) }}" class="rounded-3 img-cover" style="width: 100%; height: auto; max-height: 150px;">
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
                        <form action="{{ route('penjualan.add') }}" id="orderForm" method="POST">
                            @csrf
                            <input type="hidden" class="inputan" name="totalHarga">
                            <input type="hidden" class="inputan-pesanan" name="pesanan" value="">
                            <button type="submit" class="btn btn-primary btn-lg fs-5 m-0 mt-3 w-100">Konfirmasi</button>
                        </form>
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

            const form = document.querySelector("#orderForm");
            if (form) {
                form.addEventListener("submit", function (e) {
                    if (totalHarga === 0) {
                        e.preventDefault();
                        alert("Pilih Menu Dahulu");
                    }
                });
            }

            document.querySelectorAll(".tambah-pesanan").forEach(card => {
                card.addEventListener("click", function () {
                    const produkId = this.dataset.id;
                    const namaProduk = this.dataset.nama;
                    const hargaProduk = parseFloat(this.dataset.price);
                    const imagePath = this.querySelector("img").src;

                    totalHarga += hargaProduk;

                    if (pesanan[produkId]) {
                        pesanan[produkId].jumlah += 1;
                    } else {
                        pesanan[produkId] = { nama: namaProduk, jumlah: 1, harga: hargaProduk, image: imagePath };
                    }

                    updatePesanan();
                    updateTotalHarga();

                    const inputanElement = document.querySelector(".inputan");
                    if (inputanElement) {
                        inputanElement.value = totalHarga; 
                    }

                    const pesananInput = document.querySelector(".inputan-pesanan");
                    if (pesananInput) {
                        pesananInput.value = JSON.stringify(
                            Object.entries(pesanan).map(([id, item]) => ({
                                produkID: id,
                                jumlah: item.jumlah,
                                harga: item.harga,
                            }))
                        );
                    }
                    console.log(pesananInput.value)
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
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="${item.image}" class="rounded-3" style="width: 40px; height: 40px; object-fit: cover;">
                                <p class="m-0 ms-2">${item.nama}</p>
                            </div>
                        <div class="d-flex flex-column align-items-end">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-success me-2 tambah-jumlah" data-id="${id}" style="font-size: 14px;  margin: 2px; padding: 2px 4px; min-width: 24px; height: 24px;">+</button>
                            <input type="text" value="${item.jumlah}" class="jumlah-input" data-id="${id}" style="width: 30px; text-align: center; border:none;">
                        <button class="btn btn-danger kurang-jumlah" data-id="${id}" style="font-size: 14px; margin: 2px; padding: 2px 4px; min-width: 24px; height: 24px;">-</button>
                        </div>
                        <p class="m-0 fw-bold">${formatRupiah(item.harga)}</p>
                    </div>

                        </div>
                    `;
                    listPesanan.appendChild(card);
                }

                // Tambahkan event listener untuk input jumlah
                document.querySelectorAll(".jumlah-input").forEach(input => {
                    input.addEventListener("change", function () {
                        const produkId = this.dataset.id;
                        const newJumlah = parseInt(this.value) || 0;

                        if (newJumlah < 1) {
                            this.value = 1;
                            pesanan[produkId].jumlah = 1;
                        } else {
                            pesanan[produkId].jumlah = newJumlah;
                        }

                        recalculateTotalHarga();
                        updatePesanan();
                        updateTotalHarga();
                    });
                });

                document.querySelectorAll(".tambah-jumlah").forEach(button => {
                    button.addEventListener("click", function () {
                        const produkId = this.dataset.id;
                        pesanan[produkId].jumlah += 1;
                        totalHarga += pesanan[produkId].harga;
                        updatePesanan();
                        updateTotalHarga();
                    });
                });

                document.querySelectorAll(".kurang-jumlah").forEach(button => {
                    button.addEventListener("click", function () {
                        const produkId = this.dataset.id;
                        if (pesanan[produkId].jumlah > 1) {
                            pesanan[produkId].jumlah -= 1;
                            totalHarga -= pesanan[produkId].harga;
                        } else {
                            totalHarga -= pesanan[produkId].harga;
                            delete pesanan[produkId];
                        }
                        updatePesanan();
                        updateTotalHarga();
                    });
                });
            }

            function updateTotalHarga() {
                const totalHargaElement = document.querySelector(".total-harga");
                if (totalHargaElement) {
                    totalHargaElement.textContent = formatRupiah(totalHarga);
                }
            }

            function recalculateTotalHarga() {
                totalHarga = 0;
                for (const id in pesanan) {
                    totalHarga += pesanan[id].jumlah * pesanan[id].harga;
                }
            }
        });
    </script>
@endsection
