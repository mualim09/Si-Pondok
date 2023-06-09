<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Livewire\Absensi\Scan;
use App\Http\Livewire\Auth\Profile;
use App\Http\Livewire\Auth\SuntingProfile;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Jadwal\Perminggu;
use App\Http\Livewire\KategoriTagihan\Edit;
use App\Http\Livewire\KategoriTagihan\Semua;
use App\Http\Livewire\KategoriTagihan\Tambah;
use App\Http\Livewire\Kelas\Migrasi;
use App\Http\Livewire\Kelas\PindahKelasForm;
use App\Http\Livewire\Landing\Beranda;
use App\Http\Livewire\Presensi\DaftarSiswa;
use App\Http\Livewire\Presensi\DataKelas;
use App\Http\Livewire\Presensi\IsiLaporan;
use App\Http\Livewire\Presensi\LaporanPresensi;
use App\Http\Livewire\Presensi\ScanQrcode;
use App\Http\Livewire\Rekening\Detail;
use App\Http\Livewire\Setting\DataInstansi;
use App\Http\Livewire\Setting\Menu;
use App\Http\Livewire\Setting\ResetPassword;
use App\Http\Livewire\Tagihan\AturPerkelas;
use App\Http\Livewire\Tagihan\Bayar;
use App\Http\Livewire\Tagihan\DetailPembayaran;
use App\Http\Livewire\Tagihan\TerimaPembayaran;
use Illuminate\Support\Facades\Route;

Route::get('/', Beranda::class)->name('landing.beranda');

Route::middleware([
    'auth',
])->group(callback: function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::group(['prefix' => 'santri', 'middleware' => 'role:Administrator|Guru|BK'], function () {
        Route::get('/', \App\Http\Livewire\Santri\Semua::class)->name('santri.semua');
        Route::get('tambah', \App\Http\Livewire\Santri\Tambah::class)->name('santri.tambah');
        Route::get('detail/{id}', \App\Http\Livewire\Santri\Detail::class)->name('santri.detail');
        Route::get('edit/{id}', \App\Http\Livewire\Santri\Edit::class)->name('santri.edit');
    });
    Route::group(['prefix' => 'akademik'], function () {
        Route::group(['prefix' => 'tahun-ajaran', 'middleware' => 'role:Administrator'], function () {
            Route::get('/', \App\Http\Livewire\TahunAjaran\Semua::class)->name('tahun-ajaran.semua');
            Route::get('/tambah', \App\Http\Livewire\TahunAjaran\Tambah::class)->name('tahun-ajaran.tambah');
            Route::get('/edit/{tahun_ajaran}', \App\Http\Livewire\TahunAjaran\Edit::class)->name('tahun-ajaran.edit');
        });
        Route::group(['prefix' => 'mata-pelajaran'], function () {
            Route::get('/', \App\Http\Livewire\Mapel\Semua::class)->name('mapel.semua');
            Route::get('/tambah', \App\Http\Livewire\Mapel\Tambah::class)->name('mapel.tambah')->middleware('role:Administrator');
            Route::get('/edit/{mapel}', \App\Http\Livewire\Mapel\Edit::class)->name('mapel.edit')->middleware('role:Administrator');
            Route::get('/detail/{mapel}', \App\Http\Livewire\Mapel\Detail::class)->name('mapel.detail');
        });
        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('/', \App\Http\Livewire\Jadwal\Semua::class)->name('jadwal.semua')->middleware('role:Administrator');
            Route::get('tambah', \App\Http\Livewire\Jadwal\Tambah::class)->name('jadwal.tambah')->middleware('role:Administrator');
            Route::get('edit/{jadwal}', \App\Http\Livewire\Jadwal\Edit::class)->name('jadwal.edit')->middleware('role:Administrator');
            Route::get('detail/{jadwal}', \App\Http\Livewire\Jadwal\Detail::class)->name('jadwal.detail');
            Route::get('perminggu', Perminggu::class)->name('jadwal.perminggu');
        });
        Route::group(['prefix' => 'kelas', 'middleware' => 'role:Administrator'], function () {
            Route::get('/', \App\Http\Livewire\Kelas\Semua::class)->name('kelas.semua');
            Route::get('/tambah', \App\Http\Livewire\Kelas\Tambah::class)->name('kelas.tambah');
            Route::get('/edit/{kelas}', \App\Http\Livewire\Kelas\Edit::class)->name('kelas.edit');
            Route::get('/pindah-kelas', Migrasi::class)->name('kelas.migrasi');
            Route::get('/konfirmasi-kelas', PindahKelasForm::class)->name('kelas.konfirmasi');
            Route::get('/detail/{kelas}', \App\Http\Livewire\Kelas\Detail::class)->name('detail.kelas');
        });
    });
    Route::group(['prefix' => 'guru', 'middleware' => 'role:Administrator'], function () {
        Route::get('/', \App\Http\Livewire\Guru\Semua::class)->name('guru.semua');
        Route::get('/tambah', \App\Http\Livewire\Guru\Tambah::class)->name('guru.tambah');
        Route::get('/detail/{guru}', \App\Http\Livewire\Guru\Detail::class)->name('guru.detail');
        Route::get('/edit/{guru}', \App\Http\Livewire\Guru\Edit::class)->name('guru.edit');

        Route::group(['prefix' => 'pendidikan', 'middleware' => 'role:Administrator'], function () {
            Route::get('/', \App\Http\Livewire\RiwayatPendidikan\Semua::class)->name('riwayat-pendidikan.semua');
            Route::get('/tambah', \App\Http\Livewire\RiwayatPendidikan\Tambah::class)->name('riwayat-pendidikan.tambah');
            Route::get('/detail/{pendidikan}', \App\Http\Livewire\RiwayatPendidikan\Detail::class)->name('riwayat-pendidikan.detail');
            Route::get('/edit/{pendidikan}', \App\Http\Livewire\RiwayatPendidikan\Edit::class)->name('riwayat-pendidikan.edit');
        });
    });
    Route::group(['prefix' => 'konseling', 'middleware' => 'role:Administrator|BK'], function () {
        Route::get('/', \App\Http\Livewire\Konseling\Semua::class)->name('konseling.semua');
        Route::get('/tambah', \App\Http\Livewire\Konseling\Tambah::class)->name('konseling.tambah');
        Route::get('/detail/{konseling}', \App\Http\Livewire\Konseling\Detail::class)->name('konseling.detail');
        Route::get('/edit/{konseling}', \App\Http\Livewire\Konseling\Edit::class)->name('konseling.edit');

        Route::group(['prefix' => 'pelanggaran', 'middleware' => 'role:Administrator|BK'], function () {
            Route::get('/', \App\Http\Livewire\Pelanggaran\Semua::class)->name('pelanggaran.semua');
            Route::get('/tambah', \App\Http\Livewire\Pelanggaran\Tambah::class)->name('pelanggaran.tambah');
            Route::get('/detail/{pelanggaran}', \App\Http\Livewire\Pelanggaran\Detail::class)->name('pelanggaran.detail');
            Route::get('/edit/{pelanggaran}', \App\Http\Livewire\Pelanggaran\Edit::class)->name('pelanggaran.edit');
        });

    });
    Route::group(['prefix' => 'rekening', 'middleware' => 'role:Administrator'], function () {
        Route::get('/', \App\Http\Livewire\Rekening\Semua::class)->name('rekening.semua');
        Route::get('/tambah', \App\Http\Livewire\Rekening\Tambah::class)->name('rekening.tambah');
        Route::get('/detail/{rekening}', Detail::class)->name('rekening.detail');
        Route::get('/edit/{rekening}', \App\Http\Livewire\Rekening\Edit::class)->name('rekening.edit');
    });
    Route::group(['prefix' => 'tagihan', 'middleware' => 'role:Administrator|Siswa'], function () {
        Route::get('/', \App\Http\Livewire\Tagihan\Semua::class)->name('tagihan.semua');
        Route::get('/tambah', \App\Http\Livewire\Tagihan\Tambah::class)->name('tagihan.tambah');
        Route::get('/edit/{tagihan}', \App\Http\Livewire\Tagihan\Edit::class)->name('edit.tagihan');
        Route::get('atur-perkelas', AturPerkelas::class)->name('tagihan.atur-perkelas');
        Route::get('/detail/{tagihan}', \App\Http\Livewire\Tagihan\Detail::class)->name('tagihan.detail');
        Route::get('/terima-pembayaran/{tagihan}', TerimaPembayaran::class)->name('terima-pembayaran');
        Route::group(['prefix' => 'kategori-tagihan', 'middleware' => 'role:Administrator'], function () {
            Route::get('/', Semua::class)->name('kategori-tagihan.semua');
            Route::get('tambah', Tambah::class)->name('kategori-tagihan.tambah');
            Route::get('edit/{kategori_tagihan}', Edit::class)->name('kategori-tagihan.edit');
        });
        Route::get('/detail-pembayaran/{id}', DetailPembayaran::class)->name('detail-pembayaran');
    });
    Route::group(['prefix' => 'permission', 'middleware' => 'role:Administrator'], function () {
        Route::get('/', \App\Http\Livewire\Permission\Semua::class)->name('permission.semua');
        Route::get('/tambah', \App\Http\Livewire\Permission\Tambah::class)->name('permission.tambah');
        Route::get('/edit/{permission}', \App\Http\Livewire\Permission\Edit::class)->name('permission.edit');
    });
    Route::group(['prefix' => 'absensi'], function () {
        Route::get('scan', Scan::class)->name('absensi.scan');
    });
    Route::group(['prefix' => 'presensi'], function () {
        Route::get('/daftar-kelas', DataKelas::class)->name('presensi.daftar-kelas');
        Route::get('/daftar-siswa/{jadwal}', DaftarSiswa::class)->name('presensi.daftar-siswa');
        Route::get('/laporan', LaporanPresensi::class)->name('presensi.laporan-presensi');
        Route::get('/laporan/{jadwal}', IsiLaporan::class)->name('presensi.isi-laporan');
        Route::get('scan-qrcode', ScanQrcode::class)->name('presensi.scan-qr');
    });
    Route::group(['prefix' => 'pengaturan', 'middleware' => 'role:Administrator'], function () {
        Route::get('/', \App\Http\Livewire\Setting\Semua::class)->name('pengaturan.semua');
        Route::get('data-instansi', DataInstansi::class)->name('pengaturan.data-instansi');
        Route::get('history', \App\Http\Livewire\Log\Semua::class)->name('log.semua');
        Route::get('menu', Menu::class)->name('pengaturan.menu');
        Route::get('reset-password', ResetPassword::class)->name('reset-password');
    });

    Route::group(['auth'], function () {
        Route::get('kelaur', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('login');
        })->name('auth.keluar');
        Route::get('profile', Profile::class)->name('profile.auth');
        Route::get('sunting', SuntingProfile::class)->name('sunting-profile');
    });
});


Route::post('midtrans-response', [TransaksiController::class, 'midtransResponse'])->name('midtrans.notif');
Route::get('pembayaran-selesai', [TransaksiController::class, 'pembayaranSelesai'])->name('midtrans.selesai');
Route::get('pembayaran-pending', [TransaksiController::class, 'pembayaranPending'])->name('midtrans.pending');
Route::get('kesalahan-pembayaran', [TransaksiController::class, 'kesalahanPembayaran'])->name('midtrans.kesalahan');
Route::get('bayar/{kode}', Bayar::class)->name('tagihan.bayar');
Route::get('status-pembayaran', [TransaksiController::class, 'statusPembayaran'])->name('midtrans.status');
Route::get('ganti-pembayaran', [TransaksiController::class, 'gantiPembayaran'])->name('midtrans.ganti');
