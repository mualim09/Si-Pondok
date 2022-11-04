<?php

namespace App\Http\Livewire\Santri;

use App\Models\Akademik\Kelas;
use App\Models\Kesiswaan\Santri;
use App\Traits\KonfirmasiHapus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class Tabel extends DataTableComponent
{
    use KonfirmasiHapus;

    protected $model = Santri::class;
    protected $listeners = ['hapus' => 'dihapus'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($id) {
                return route('santri.detail', $id);
            });
        $this->setDefaultReorderSort('order', 'desc');

    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Jenis Kelamin')
                ->options([
                    '' => 'Semua',
                    'Perempuan' => 'Perempuan',
                    'Laki-Laki' => 'Laki-Laki',
                ])->filter(function (Builder $query, $value) {
                    if ($value) {
                        $query->where('jenis_kelamin', $value);
                    }
                }),

            SelectFilter::make('Kelas')
                ->options(
                    Kelas::query()->orderBy('nama_kelas')
                        ->get()
                        ->keyBy('id')
                        ->map(fn($kelas) => $kelas->nama_kelas)
                        ->toArray()
                )->filter(function (Builder $query, string $kelas) {
                    return $query->whereHas('kelas', function ($query) use ($kelas) {
                        return $query->where('id', $kelas);
                    });
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')->sortable(),
            Column::make("NISN", "nisn")
                ->searchable()
                ->sortable(),
            Column::make("Nama", "nama_lengkap")
                ->searchable(fn(Builder $query, $keyword) => $query->orWhere('nama_lengkap', 'like', "%{$keyword}%"))
                ->html()
                ->format(function ($nama) {
                    return "<span class='fw-bold text-success'>$nama</span>";
                })
                ->sortable(),
            Column::make("Jenis Kelamin", "jenis_kelamin")
                ->unclickable()
                ->sortable(),
            Column::make("Tempat Lahir", "tempat_lahir")
                ->unclickable()
                ->sortable(),
            Column::make("Tanggal Lahir", "tanggal_lahir")
                ->unclickable()
                ->format(fn($tanggal_lahir) => Carbon::parse($tanggal_lahir)->format('d F Y'))
                ->sortable(),
            Column::make('Agama', 'agama')
                ->unclickable(),
            Column::make('Status Keluarga', 'status_keluarga')
                ->unclickable()->deselected(),
            Column::make('Anak Ke', 'anak_ke')
                ->unclickable()->deselected(),
            Column::make('Jumlah Saudara', 'jumlah_saudara')
                ->unclickable()->deselected(),
            Column::make('Aksi', 'id')
                ->html()
                ->format(function ($id) {
                    return view('tombol-aksi', [
                        'edit' => route('santri.edit', $id),
                        'hapus' => $id
                    ]);
                })
                ->unclickable()
                ->excludeFromColumnSelect(),
        ];
    }

    public function dihapus()
    {
        if ($this->model_id) {
            $santri = Santri::find($this->model_id);
            $santri->delete();
            $this->alert('success', "Data berhasil dihapus");
        } else {
            $this->alert('error', "Data gagal dihapus");
        }
    }
}
