<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <title>Nota Penjualan</title>
</head>
<body class="p-3">
    <div class="row">
        <div class="col-3">
            <div class="card shadow-sm">
                <section id="captureArea">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center" style="padding-left: 40px; padding-right: 40px">
                                <img src="{{ asset('assets/logo/cashier.png') }}" width="50%" class="mb-2">
                                <h6 class="text-dark m-0 fw-medium">Eskalaber Foodies</h6>
                                <h6 class="text-dark m-0 lh-sm fw-medium">Jl. Semboro - Paleran, Babatan, Sidomekar, Kec. Semboro, Kabupaten Jember, Jawa Timur</h6>
                                <h6 class="text-dark mb-3 lh-sm fw-medium">eskalaber-foodies.com</h6>
                            </div>
                            <div class="col-12 px-3">
                                <hr class="dotted-black">
                                <div class="row mb-3 pe-0">
                                    <div class="col-md-5">
                                        <h6 class="fw-bold mb-0">Nama Produk</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="fw-bold mb-0 text-center w-25">Qty</h6>
                                            <h6 class="fw-bold mb-0 text-center w-25">Harga</h6>
                                            <h6 class="fw-bold mb-0 text-center w-25">Total</h6>
                                        </div>
                                    </div>
                                </div>
                                <hr class="dotted-black">
                            </div>
                            <div class="col-12 px-3">
                                @foreach ($detail as $d)
                                <div class="row">
                                    <div class="col-md-5">
                                        <p class="fw-bold mb-0">{{ $d->produk->NamaProduk }}</p>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 fw-bold text-center w-25">{{ $d->JumlahProduk }}</p>
                                            <p class="mb-0 fw-bold text-center w-25">{{ formatRp($d->produk->Price) }}</p>
                                            <p class="mb-0 fw-bold text-center w-25">{{ formatRp($d->Subtotal) }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <hr class="dotted-black">
                            </div>
                            <div class="col-12 px-3">
                                <div class="row">
                                    <h6 class="col-4 mb-0 text-dark fw-medium">Total</h6>
                                    <h6 class="col-8 mb-0 text-dark fw-medium">: Rp, {{ $penjualan->TotalHarga ? formatRp($penjualan->TotalHarga) : '-' }}</h6>
                                </div>
                                <div class="row">
                                    <h6 class="col-4 mb-0 text-dark fw-medium">MetBay</h6>
                                    <h6 class="col-8 mb-0 text-dark fw-medium">: {{ getPaymentMethod($penjualan->Metode) }} (Rp, {{ $penjualan->Dibayar ? formatRp($penjualan->Dibayar) : '-' }})</h6>
                                </div>
                                <div class="row">
                                    <h6 class="col-4 mb-0 text-dark fw-medium">Kembali</h6>
                                    <h6 class="col-8 mb-0 text-dark fw-medium">: Rp, {{ $penjualan->Kembali ? formatRp($penjualan->Kembali) : '-' }}</h6>
                                </div>
                                <hr class="dotted-black">
                            </div>
                            <div class="col-12 px-3">
                                <div class="row">
                                    <h6 class="text-dark fw-medium mb-0" id="code">{{ $penjualan->Kode }}</h6>
                                    <h6 class="text-dark fw-medium mb-0">{{ formatTanggal($penjualan->TanggalPenjualan) }}, Opr: {{ $penjualan->user->username }}</h6>
                                    <h6 class="text-dark fw-medium mb-0">Terima kasih telah menikmati hidangan kami di Eskalaber Foodies. Semoga hari Anda menyenangkan!</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <script>
            window.onload = function() {
                html2canvas(document.getElementById('captureArea')).then(function(canvas) {
                    var img = canvas.toDataURL("image/png");
                    var code = document.getElementById('code').innerText;
                    var a = document.createElement('a');
                    a.href = img;
                    a.download = `[${code}]Penjualan.png`;
                    a.click();
                });
            };
        </script>

</body>
</html>