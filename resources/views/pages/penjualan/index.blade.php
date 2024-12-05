@extends('layouts.app')

@section('content')
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @endpush
    @include('layouts.navbars.auth.topnav', ['title' => 'Penjualan'])
    <div class="row mt-4 mx-4">
        <div class="col-9">
            <div class="card pb-4">
                <div class="card-header pb-3 d-flex align-items-center justify-content-between">
                    <h5>Penjualan</h5>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="card d-none border-1 border-secondary">
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
                        <form id="orderForm">
                            <button type="button" data-bs-target="#staticBackdrop" class="btn btn-primary btn-lg fs-5 m-0 mt-3 w-100">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('penjualan.add') }}" id="formSubmit" method="POST">
                        @csrf
                        <input type="hidden" class="inputan" name="totalHarga">
                        <input type="hidden" class="inputan-pesanan" name="pesanan" value="">
                        <input type="hidden" class="inputan-kembalian" name="kembalian" id="kembalianInput">
                        <select name="pelanggan" class="form-select mb-3">
                            <option value="" selected>- Pilih Pelaggan -</option>
                            @foreach ($pelanggan as $p)
                                <option value="{{ $p->id }}" {{ old('NamaPelanggan') == $p->id ? 'selected' : '' }}>{{ $p->NamaPelanggan }}</option>
                            @endforeach
                        </select>
                        <select class="form-select mb-3" name="meja" id="">
                                <option value="" selected>- Pilih Meja -</option>
                                @foreach ($meja as $k)
                                    <option value="{{ $k->id }}" {{ old('meja') == $k->id ? 'selected' : '' }}>{{ $k->meja }}</option>
                                @endforeach
                        </select>
                        <select required class="form-select mb-3" name="metode" id="">
                            <option selected>- Pilih Metode Pembayaran -</option>
                            <option value="1">Tunai</option>
                            <option value="2">QRIS</option>
                            <option value="3">Transfer</option>
                        </select>
                        <div class="row g-2">
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="harga_formatted" class="form-control me-2" id="bayar" placeholder="Dibayar...">
                                    <input type="hidden" name="bayar_raw" id="harga_raw">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="m-0 fw-medium">Kembalian: <span class="kembalian text-dark fw-bold"></span></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" form="formSubmit" class="btn btn-primary">Buat Pesanan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var cleave = new Cleave('#bayar', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '.', 
            numeralDecimalMark: ',' 
        });

        document.getElementById('bayar').addEventListener('input', function () {
            var rawValue = cleave.getRawValue(); 
            document.getElementById('harga_raw').value = rawValue;
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pesanan = {};
            let totalHarga = 0;

            function formatRupiah(angka) {
                return `Rp${angka.toLocaleString('id-ID')}`;
            }

            const form = document.querySelector("#orderForm");
            const button = form.querySelector('button[type="button"]');

            if (button) {
                button.addEventListener("click", function (e) {
                    if (Object.keys(pesanan).length === 0) {
                        e.preventDefault();
                        alert("Pilih Menu Dahulu");

                        button.removeAttribute("data-bs-toggle");
                    } else {
                        if (!button.hasAttribute("data-bs-toggle")) {
                            button.setAttribute("data-bs-toggle", "modal");
                        }
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

            const bayarInput = document.querySelector("#bayar");
            const kembalianInput = document.getElementById("kembalianInput");

            function updateKembalian() {
                const bayar = parseFloat(cleave.getRawValue()) || 0;
                const kembalianElement = document.querySelector(".kembalian");
                const kembalian = bayar - totalHarga;

                if (kembalian >= 0) {
                    kembalianElement.textContent = formatRupiah(kembalian);
                    kembalianInput.value = kembalian;
                } else {
                    kembalianElement.textContent = "Belum cukup";
                    kembalianInput.value = ""
                }
            }

            if (bayarInput) {
                bayarInput.addEventListener("input", function () {
                    updateKembalian();
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
