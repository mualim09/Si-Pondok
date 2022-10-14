<?php

namespace App\Models\Keuangan;

use App\Models\Kesiswaan\Santri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(KategoriTagihan::class,'kategori_tagihan_id', 'id');
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_tagihan', 'transaksi_id');
    }
}
