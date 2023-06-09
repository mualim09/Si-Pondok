<?php

namespace App\Http\Controllers;

use App\Models\Keuangan\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function midtransResponse(Request $request)
    {
        try {
            $transaksi = Transaksi::where('order_id', $request->order_id)->first();

            if ($request->payment_type == 'cstore') {
                $jenis_pembayaran = \Str::title($request->store);
            } elseif ($request->payment_type == 'bank_transfer') {
                $jenis_pembayaran = \Str::upper($request->va_numbers[0]['bank']);
            } else {
                $jenis_pembayaran = \Str::title($transaksi->jenis_pembayaran);
            }

            if ($request->transaction_status != 'settlement') {
                $status = $request->transaction_status;
            } else {
                $status = 'berhasil';
            }

            $transaksi->update([
                'waktu_transaksi' => $request->transaction_time,
                'status_transaksi' => $status,
                'toko' => $request->store,
                'keterangan_status' => $request->status_message,
                'kode_status' => $request->status_code,
                'tanda_terima' => $request->signature_key,
                'waktu_penyelesaian' => now()->toDateTimeString(),
                'jenis_pembayaran' => $jenis_pembayaran,
                'kode_pembayaran' => $request->payment_code,
                'merchant_id' => $request->merchant_id,
                'total' => $request->gross_amount,
                'mata_uang' => 'IDR',
                'kode_persetujuan' => $request->approval_code,
                'penipuan_status' => $request->fraud_status,
            ]);

            return response()->json($transaksi, '200', [], JSON_PRETTY_PRINT);

        } catch (\Exception $exception) {
            report($exception);

            return response()->json('Transaksi tidak ditemukan', '404', [], JSON_PRETTY_PRINT);

        }

    }

    public function pembayaranSelesai(Request $request)
    {
        $transaksi = Transaksi::where('order_id', $request->order_id)->first();
        return view('midtrans.pembayaran-selesai', compact('transaksi'));
    }

    public function pembayaranPending(Request $request)
    {
        $transaksi = Transaksi::where('order_id', $request->order_id)->firstOrFail();

        $tagihan = $transaksi->tagihan;

        if ($tagihan->status == 'lunas') {
            return redirect()->route('midtrans.selesai', ['order' => $request->order_id]);
        }

        return view('midtrans.pembayaran-pending', compact('transaksi'));
    }

    public function kesalahanPembayaran(Request $request)
    {
        $transaksi = Transaksi::where('order', $request->order_id)->first();

        $tagihan = $transaksi->tagihan;

        if ($tagihan->status == 'lunas') {
            return redirect()->route('midtrans.selesai', ['order' => $request->order_id]);
        }

        return view('midtrans.kesalahan-pembayaran', compact('transaksi'));
    }

    public function statusPembayaran(Request $request)
    {
        if ($request->transaction_status == 'pending') {
            return redirect()->route('midtrans.pending', ['order' => $request->order_id]);
        } elseif ($request->transaction_status == 'settlement') {
            return redirect()->route('midtrans.selesai', ['order' => $request->order_id]);
        } else {
            return redirect()->route('midtrans.pending', ['order' => $request->order_id]);
        }
    }

    public function gantiPembayaran($id)
    {
        $transaksi = Transaksi::where('order', $id)->first();
        return view('midtrans.ganti-pembayaran', compact('transaksi'));
    }

}
