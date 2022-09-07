<?php

namespace App\Http\Livewire\Tagihan;

use App\Models\KategoriTagihan;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Services\PaymentGateway\CreateTokenService;
use App\Services\PaymentGateway\Midtrans;
use Carbon\Carbon;
use Livewire\Component;

class Bayar extends Component
{
    public $transaksi;
    public $token;
    public $tagihan;
    public $kode;

    public function mount($kode)
    {
        $this->transaksi = Transaksi::where('order_id', $kode)->first();

        $midtrans = new CreateTokenService($this->transaksi);
        $kategori = KategoriTagihan::find($this->transaksi->tagihan->kategori_tagihan_id);
        if ($kategori){
            $kode_tagihan = $kategori->kode;
        }
        //update kode tagihan dengan waktu sekarang
        $nomor_tagihan = Tagihan::max('id') + 1;
        $siswa = $this->transaksi->tagihan->santri;
        $this->kode = "{$kode_tagihan}-".Carbon::now()->format('dmys-') . $nomor_tagihan . "-" . $siswa->id;
        $this->transaksi->order_id = $this->kode;
        $this->token = $midtrans->generateSnapToken();
        $this->tagihan = $this->transaksi->tagihan;

        if ($this->tagihan->status == 'lunas'){
            return redirect()->route('midtrans.selesai', ['order_id' => $kode]);
        }

    }

    public function pay()
    {

        $this->transaksi->update([
            'order_id' => $this->kode,
        ]);

        $this->emit('snapPay', $this->token);

    }

    public function render()
    {
        return view('livewire.tagihan.bayar')->layout('layouts.guest');
    }
}
