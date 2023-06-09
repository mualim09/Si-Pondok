<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Transaksi implements TransaksiInterface
{
    public function create(array $tagihan)
    {
        \App\Models\Keuangan\Transaksi::create([
            'waktu_transaksi' => Carbon::now()->toDateTimeString(),
            'status_transaksi' => 'pending',
            'toko' => 'belum diketahui',
            'keterangan_status' => 'Menunggu pembayaran yang dipilih oleh santri',
            'kode_status' => 'pending',
            'transaksi_id' => $tagihan['kode_transaksi'],
            'tanda_terima' => 'belum diketahui',
            'waktu_penyelesaian' => 'belum diketahui',
            'jenis_pembayaran' => 'belum diketahui',
            'kode_pembayaran' => 'belum diketahui',
            'order_id' => $tagihan['kode_tagihan'],
            'merchant_id' => 'belum diketahui',
            'total' => $tagihan['total_tagihan'],
            'mata_uang' => 'IDR',
            'kode_persetujuan' => 'belum diketahui',
            'penipuan_status' => 'belum diketahui',
            'token' => Str::uuid(),
            'kode_referensi' => $tagihan['kode_transaksi']
        ]);

    }
}
