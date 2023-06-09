<?php

namespace App\Http\Livewire\Santri;

use App\Models\Kesiswaan\Santri;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $nama_lengkap;
    public $nama_panggilan;
    public $nisn;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $agama;
    public $jenis_kelamin;
    public $anak_ke;
    public $jumlah_saudara;
    public $status_keluarga;
    public $email;
    public $no_hp;
    public $alamat;
    public $nik;
    public $avatar;
    public $avatar_saat_ini;
    public $santri_id;

    public $listeners = ['disimpan' => 'simpan'];

    public function mount($id)
    {
        $santri = Santri::find($id);
        $this->santri_id = $santri->id;
        $this->nama_lengkap = $santri->nama_lengkap;
        $this->nama_panggilan = $santri->nama_panggilan;
        $this->nisn = $santri->nisn;
        $this->tempat_lahir = $santri->tempat_lahir;
        $this->tanggal_lahir = $santri->tanggal_lahir;
        $this->agama = $santri->agama;
        $this->jenis_kelamin = $santri->jenis_kelamin;
        $this->anak_ke = $santri->anak_ke;
        $this->jumlah_saudara = $santri->jumlah_saudara;
        $this->status_keluarga = $santri->status_keluarga;
        $this->email = $santri->email;
        $this->no_hp = $santri->no_hp;
        $this->alamat = $santri->alamat;
        $this->nik = $santri->nik;
        $this->avatar_saat_ini = $santri->avatar->nama_file;
    }

    public function updatedJumlahSaudara($value)
    {
        if ($value > 1) {
            $this->anak_ke = 1;
        } else {
            $this->anak_ke = 1;
        }
    }


    public function rules()
    {
        return [
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'nisn' => 'required|min_digits:9|max_digits:9|unique:santris,nisn,' . $this->santri_id,
            'jumlah_saudara' => ['required', 'numeric', 'min:1'],
            'anak_ke' => 'required|lte:jumlah_saudara',
            'avatar' => 'nullable|max:1024|mimes:jpg,png,jpeg,webp,jpe',
            'nik' => 'required|min_digits:9|max_digits:20|unique:santris,nik,' . $this->santri_id,
            'email' => 'email|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'avatar.max' => 'Foto maksimal ukuran 1 Mb'
        ];
    }

    public function updated($field)
    {
        return $this->validateOnly($field);
    }

    public function konfirmasiSimpan()
    {
        $this->validate();

        $this->confirm('Yakin akan edit data ini?', [
            'text' => 'Data lama tidak akan bisa di kembalikan',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Yakin',
            'denyButtonText' => 'Tidak',
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'disimpan',
            'allowOutsideClick' => false,
            'timer' => null,
            'iconHtml' => '<img class="img-fluid" src="/assets/icons/sad.png"/>',
        ]);

    }


    public function simpan()
    {
        try {

            $santri = Santri::find($this->santri_id);

            $santri->user->syncRoles('Siswa');

            $santri->update([
                'nama_lengkap' => $this->nama_lengkap,
                'nama_panggilan' => $this->nama_panggilan,
                'nisn' => $this->nisn,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'agama' => $this->agama,
                'jenis_kelamin' => $this->jenis_kelamin,
                'anak_ke' => $this->anak_ke,
                'jumlah_saudara' => $this->jumlah_saudara,
                'status_keluarga' => $this->status_keluarga,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'nik' => $this->nik,
            ]);

            if ($this->avatar) {
                $uuid = \Str::uuid();
                $nama_file = Str::slug($santri->nama_lengkap) . "-{$uuid}.{$this->avatar->extension()}";
                $santri->avatar()->updateOrCreate([
                    'nama_file' => $this->avatar->storeAs('upload', $nama_file),
                ]);
            }

            $this->flash('success', "Santri {$this->nama_lengkap} berhasil diperbarui", [], route('santri.semua'));

        } catch (\Exception $e) {
            report($e);
            Debugbar::info($e);
            $this->alert('error', 'Kesalahan', [
                'text' => 'Terjadi kesalahan saat menyimpan data',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.santri.edit');
    }
}
