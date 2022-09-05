<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'kode_tagihan', 'transaksi_id');
    }
}