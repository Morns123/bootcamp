<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trx_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('mst_user', 'id');
            $table->foreignId('dtl_buku_id')->constrained('dtl_buku', 'id');
            $table->enum('tipe', ['PINJAM', 'KEMBALI']);
            $table->date('tgl_transaksi');
            $table->timestamps();
            $table->foreignId('created_by');
            $table->foreignId('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_peminjaman');
    }
};
