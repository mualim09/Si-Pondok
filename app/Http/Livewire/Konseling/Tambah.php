<?php

namespace App\Http\Livewire\Konseling;

use App\Models\Kesiswaan\Konseling;
use App\Models\Kesiswaan\Pelanggaran;
use App\Models\Kesiswaan\Santri;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tambah extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $santri_id;
    public $tanggal;
    public $pelanggaran_id;
    public $keterangan;
    public $foto_bukti;

    public function rules()
    {
        return [
            'santri_id' => 'required',
            'tanggal' => 'required',
            'pelanggaran_id' => 'required',
            'foto_bukti' => 'nullable|image|max:1024|mimes:jpg,png,jpeg,webp',
        ];
    }

    public function messages()
    {
        return [
            'foto_bukti.max' => 'Foto maksimal ukuran 1 Mb'
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function simpan()
    {
        $this->validate();
        try {
            if ($this->foto_bukti){
                $santri = Santri::find($this->santri_id);
                $nama_file = \Str::slug($santri->nama_lengkap) . '-' . \Str::uuid() . ".{$this->foto_bukti->extension()}";
                $nama_file = $this->foto_bukti->storeAs('upload', $nama_file);
            }else{
                $nama_file = null;
            }
            Konseling::create([
                'santri_id' => $this->santri_id,
                'pelanggaran_id' => $this->pelanggaran_id,
                'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'),
                'keterangan' => $this->keterangan,
                'foto_bukti' => $nama_file
            ]);
            $this->alert('success', 'Data Berhasil disimpan');
            $this->reset();
        } catch (\Exception $e) {
            report($e);
            $this->alert('error', 'Kesalahaan saat mau menyimpan data');
        }
    }

    public function render()
    {
        $pelanggaran = Pelanggaran::orderBy('bobot', 'asc')->get();
        $siswa = Santri::orderBy('nama_lengkap', 'asc')->get();
        return view('livewire.konseling.tambah', [
            'semua_siswa' => $siswa,
            'semua_pelanggaran' => $pelanggaran
        ]);
    }
}
