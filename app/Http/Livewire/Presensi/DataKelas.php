<?php

namespace App\Http\Livewire\Presensi;

use App\Models\AbsensiGuru;
use App\Models\Akademik\Jadwal;
use Carbon\Carbon;
use Livewire\Component;

class DataKelas extends Component
{
    public $status_absensi;

    public function mount()
    {
        $hari_ini = now();
        $guru_id = auth()->user()->guru->id;

        $absensi = AbsensiGuru::where('guru_id', $guru_id)->whereDate('waktu_absensi', now())->get();

        if ($absensi->count() >= 1) {
            $this->status_absensi = 'valid';
        }
    }

    public function render()
    {
        $hari_ini = Carbon::now()->isoFormat('dddd');

        $jadwal_perguru = Jadwal::where('guru_id', auth()->user()->guru->id)
            ->where('hari', $hari_ini)
            ->where('status', 'aktif')
            ->get();

        $jadwal_hari_ini = Jadwal::where('hari', $hari_ini)
            ->where('status', 'aktif')
            ->where('guru_id', '!=', auth()->user()->guru->id)
            ->get();

        return view('livewire.presensi.data-kelas',[
            'data_jadwal_guru' => $jadwal_perguru,
            'data_jadwal_hari_ini' => $jadwal_hari_ini
        ]);
    }
}
