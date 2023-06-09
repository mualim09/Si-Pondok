<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'kode_referensi', 'kode_transaksi');
    }

}
