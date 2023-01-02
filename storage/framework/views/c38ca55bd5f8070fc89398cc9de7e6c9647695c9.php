<div>
    
    <div class="row justify-content-lg-between">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header border-0">
                    <h1 class="card-title">Pengaturan Tagihan</h1>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="simpan">
                        <div class="form-group mb-3">
                            <?php if (isset($component)) { $__componentOriginale3e27020619c7dd176dc386b70690b75269969a6 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormSelect::resolve(['label' => 'Pilih Kelas','name' => 'kelas'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormSelect::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'kelas']); ?>
                                <option value="">Pilih Kelas</option>
                                <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kelas->id); ?>"><?php echo e($kelas->nama_kelas); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3e27020619c7dd176dc386b70690b75269969a6)): ?>
<?php $component = $__componentOriginale3e27020619c7dd176dc386b70690b75269969a6; ?>
<?php unset($__componentOriginale3e27020619c7dd176dc386b70690b75269969a6); ?>
<?php endif; ?>
                        </div>
                        <div class="form-group mb-3">
                            <?php if (isset($component)) { $__componentOriginale3e27020619c7dd176dc386b70690b75269969a6 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormSelect::resolve(['name' => 'kategori_id','label' => 'Kategori'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormSelect::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'kategori_id']); ?>
                                <option value="">Pilih Kategori</option>
                                <?php $__currentLoopData = $data_kategori_tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori_tagihan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori_tagihan->id); ?>"><?php echo e($kategori_tagihan->nama_kategori); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3e27020619c7dd176dc386b70690b75269969a6)): ?>
<?php $component = $__componentOriginale3e27020619c7dd176dc386b70690b75269969a6; ?>
<?php unset($__componentOriginale3e27020619c7dd176dc386b70690b75269969a6); ?>
<?php endif; ?>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <?php if (isset($component)) { $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormInput::resolve(['type' => 'date','name' => 'tgl_tagihan','label' => 'Tanggal Tagihan'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'tgl_tagihan']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4)): ?>
<?php $component = $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4; ?>
<?php unset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4); ?>
<?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <?php if (isset($component)) { $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormInput::resolve(['type' => 'date','name' => 'tgl_jatuh_tempo','label' => 'Tgl. Terakhir Pembayaran'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'tgl_jatuh_tempo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4)): ?>
<?php $component = $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4; ?>
<?php unset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3" wire:ignore>
                            <?php if (isset($component)) { $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormInput::resolve(['name' => 'jumlah','label' => 'Jumlah Tagihan'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-end','id' => 'jumlah','placeholder' => 'Rp. 80.000']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4)): ?>
<?php $component = $__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4; ?>
<?php unset($__componentOriginalc6dc29918f642c0cf8bf87f6c59d196df1a6e1b4); ?>
<?php endif; ?>
                        </div>
                        <div class="form-gorup mb-3">
                            <?php if (isset($component)) { $__componentOriginal83693b8429d83ac47ac0f5a27736a9481ab05e28 = $component; } ?>
<?php $component = ProtoneMedia\LaravelFormComponents\Components\FormTextarea::resolve(['name' => 'notes','label' => 'Notes'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form-textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(ProtoneMedia\LaravelFormComponents\Components\FormTextarea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'notes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal83693b8429d83ac47ac0f5a27736a9481ab05e28)): ?>
<?php $component = $__componentOriginal83693b8429d83ac47ac0f5a27736a9481ab05e28; ?>
<?php unset($__componentOriginal83693b8429d83ac47ac0f5a27736a9481ab05e28); ?>
<?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="<?php echo e(route('kategori-tagihan.semua')); ?>">
                                <button type="button" class="btn btn-light btn-border d-flex align-items-center gap-1 waves-effect">
                                    <i class="ri-arrow-go-back-line fs-16"></i>
                                    Kembali
                                </button>
                            </a>
                            <button class="btn btn-success btn-border d-flex align-items-center gap-1" >
                                <i class="ri-save-line fs-16"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <?php if(count($data_santri) > 0): ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            Informasi Siswa
                        </h5>
                        <div class="card-body">
                            <div class="alert alert-info">
                                Semua kelas yang tercantum pada tabel ini akan dibuatkan sebuah tagian sesuai dengan
                                tagihan yang sudah di tentukan pada form tagihan
                            </div>
                            <table class="table table-sm table-hover ">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NISN</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data_santri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $santri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($santri->nama_lengkap); ?></td>
                                        <td><?php echo e($santri->nisn); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <strong>Total: <?php echo e($data_santri->count()); ?> Siswa</strong>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        var jumlah = document.getElementById('jumlah')
        jumlah.addEventListener('keyup', (event) => {
            rupiah(jumlah)
            window.livewire.find('<?php echo e($_instance->id); ?>').set('jumlah', rupiah(jumlah))
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\abdas\Documents\GitHub\madrosy\resources\views/livewire/tagihan/atur-perkelas.blade.php ENDPATH**/ ?>