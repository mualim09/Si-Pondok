<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col-md-5">
                <div class="card border-light shadow-sm">
                    <div class="card-body text-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/lupuorrc.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                        <h3 class="">Pembayaran Selesai</h3>
                        <small class="text-muted">Tunggu sebentar kami akan informasikan lagi setelah pembayaran berhasil</small>
                    </div>
                    <div class="card-body py-4">
                        <h5>Informasi</h5>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Tgl. Pembayaran</div>
                            <div class="text-muted">{{\Carbon\Carbon::parse($transaksi->waktu_transaksi)->format('d M, Y H:i')}}</div>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Metode Pembayaran</div>
                            <div class="text-muted">{{$transaksi->jenis_pembayaran}}</div>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Total Pembayaran</div>
                            <div class="text-muted">Rp. {{rupiah($transaksi->total)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
