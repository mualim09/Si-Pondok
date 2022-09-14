<?php

namespace App\Http\Livewire\Mapel;

use App\Http\Livewire\Modal;
use App\Models\Mapel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Symfony\Component\ErrorHandler\Debug;

class Tambah extends Modal
{
    use LivewireAlert;
    public $nama;
    public $kode;

    public function mount()
    {
        $kode = Mapel::max('id');

        $this->kode = 'MPL-' . str_pad($kode + 1, 3, '0', STR_PAD_LEFT);
    }

    protected $listeners = ['tambah' => 'show'];

    public function show()
    {
        $this->emit('modalTambah', 'tambah-mapel');
    }

    public function rules()
    {
        return[
            'nama' => 'required',
            'kode' => 'required|unique:mapels,kode'
        ];
    }

    public function simpan()
    {
        $this->validate();

        try {
            $mapel = Mapel::create([
                'kode' => $this->kode,
                'nama' =>   $this->nama,
                'dibuat_oleh' => auth()->id(),
                'diubah_oleh' => auth()->id()
            ]);
            $this->emit('mapelDitambah', $mapel);
            $this->alert('success', 'Data berhasil disimpan');
            $this->reset();
            $this->mount();
        }catch (\Exception $e){
            \Debugbar::info($e);
            $this->alert('error', 'Data gagal disimpan');
        }
    }

    public function render()
    {
        return view('livewire.mapel.tambah');
    }
}