<?php

namespace App\Http\Livewire\RiwayatPendidikan;

use App\Models\Kepegawaian\Guru;
use App\Models\Kepegawaian\RiwayatPendidikan;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public $guru_id;
    public $nama_sekolah;
    public $alamat_sekolah;
    public $tahun_lulus;
    public $tahun_masuk;
    public $jurusan;
    public $jenjang_pendidikan;

    public $pendidikan_id;

    public function mount($pendidikan)
    {
        $pendidikan = RiwayatPendidikan::find($pendidikan);
        $this->guru_id = $pendidikan->guru_id;
        $this->nama_sekolah = $pendidikan->nama_sekolah;
        $this->alamat_sekolah = $pendidikan->alamat_sekolah;
        $this->tahun_lulus = $pendidikan->tahun_lulus;
        $this->tahun_masuk = $pendidikan->tahun_masuk;
        $this->jurusan = $pendidikan->jurusan;
        $this->jenjang_pendidikan = $pendidikan->jenjang_pendidikan;
        $this->pendidikan_id = $pendidikan->id;

    }

    public function rules()
    {
        return [
            'guru_id' => 'required|numeric',
            'nama_sekolah' => 'required',
            'alamat_sekolah' => 'required',
            'tahun_lulus' => 'required',
            'tahun_masuk' => 'required',
            'jenjang_pendidikan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'guru_id.required' => 'Guru harus diisi',
            'nama_sekolah.required' => 'Nama sekolah harus diisi',
            'alamat_sekolah.required' => 'Alamat sekolah harus diisi',
            'tahun_lulus.required' => 'Tahun lulus harus diisi',
            'tahun_lulus.date' => 'Tahun lulus harus berupa tanggal',
            'tahun_lulus.max' => 'Tahun lulus harus berupa tanggal',
            'tahun_lulus.min' => 'Tahun lulus harus berupa tanggal',
            'tahun_masuk.required' => 'Tahun masuk harus diisi',
            'tahun_masuk.date' => 'Tahun masuk harus berupa tanggal',
            'tahun_masuk.max' => 'Tahun masuk harus berupa tanggal',
            'tahun_masuk.min' => 'Tahun masuk harus berupa tanggal',
            'guru_id.numeric' => 'Guru harus berupa angka',
            'jenjang_pendidikan.required' => 'Jenjang pendidikan harus diisi'
        ];
    }

    public function simpan()
    {
        $this->validate();
        try {

            $guru = Guru::find($this->guru_id);

            $guru->pendidikan()->where('id', $this->pendidikan_id)->update([
                'nama_sekolah' => $this->nama_sekolah,
                'alamat_sekolah' => $this->alamat_sekolah,
                'tahun_lulus' => Carbon::parse($this->tahun_lulus)->format('Y-m-d'),
                'jurusan' => $this->jurusan,
                'tahun_masuk' => Carbon::parse($this->tahun_masuk)->format('Y-m-d'),
                'jenjang_pendidikan' => $this->jenjang_pendidikan
            ]);

            $this->alert('success', 'Data berhasil di ubah');

        }catch (\Exception $e) {
            $this->alert('warning', 'Kesalahan saat memperbarui data');
        }
    }


    public function render()
    {
        $semua_guru = Guru::orderBy('nama', 'asc')->get();
        return view('livewire.riwayat-pendidikan.edit',[
            'semua_guru' => $semua_guru
        ]);
    }
}
