<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, [] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(App\View\Components\GuestLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh">
            <div class="col-md-5">
                <div class="card border-light shadow-sm">
                    <div class="card-body text-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/osvvqecf.json"
                            trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>
                        <h3 class="">Pembayaran Dalam Proses</h3>
                        <small class="text-muted">Silahkan lakukan pembayaran sesuai Metode yang dipilih, Jika sudah melakukan pembayaran silahkan cek statusnya dengan cara klik tombol <strong>Cek Status</strong></small>
                    </div>
                    <div class="card-body">
                        <h5>Informasi</h5>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Tgl. Pembayaran</div>
                            <div class="text-muted"><?php echo e(\Carbon\Carbon::parse($transaksi->waktu_transaksi)->format('d M, Y H:i')); ?></div>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Metode Pembayaran</div>
                            <div class="text-muted"><?php echo e($transaksi->jenis_pembayaran); ?></div>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-bottom border-light">
                            <div class="text-muted">Total Pembayaran</div>
                            <div class="text-muted">Rp. <?php echo e(rupiah($transaksi->total)); ?></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if($transaksi->status_transaksi != 'settlement'): ?>
                            <a href="<?php echo e(route('tagihan.bayar', ['kode' => $transaksi->order_id])); ?>">
                            <span class="d-grid">
                                <button id="btnPay" class="btn btn-info btn-border mb-2">
                                    Baya Sekarang
                                </button>
                            </span>
                            </a>
                            <a href="<?php echo e(route('midtrans.status', ['order_id' => $transaksi->order_id])); ?>">
                                <span class="d-grid">
                                    <button id="btnPay" class="btn btn-dark">
                                        Cek Status
                                    </button>
                                </span>
                            </a>
                        <?php else: ?>
                            <div class="d-grid">
                                <button id="btnPay" class="btn btn-success disabled">
                                    Pembayaran Kamu Sudah Lunas
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript"
            src="<?php echo e(config('midtrans.midtrans_snap_url')); ?>"
            data-client-key="<?php echo e(config('midtrans.client_key')); ?>">
    </script>

    <script>
        let btnPay = document.getElementById('btnPay');
        btnPay.addEventListener('click', function () {
            window.snap.pay("<?php echo e($transaksi->token); ?>");
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php /**PATH /home/aziz/SKA Project/madrosy/resources/views/midtrans/pembayaran-pending.blade.php ENDPATH**/ ?>