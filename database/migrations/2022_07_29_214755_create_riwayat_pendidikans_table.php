<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained();
            $table->enum('jenjang_pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->string('nama_sekolah');
            $table->text('alamat_sekolah');
            $table->date('tahun_masuk');
            $table->date('tahun_lulus');
            $table->string('jurusan')->nullable()->default('tidak ada');
            $table->string('dibuat_oleh');
            $table->string('diubah_oleh')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikans');
    }
};
