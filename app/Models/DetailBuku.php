<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBuku extends Model
{
    use HasFactory;

    protected $table = "dtl_buku";

    protected $guarded = ['id'];

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function transaksiMasuk(){
        return $this->belongsTo(TransaksiBuku::class, 'trx_in_id');
    }

    public function transaksiKeluar(){
        return $this->belongsTo(TransaksiBuku::class, 'trx_out_id');
    }

    public function peminjamans() {
        return $this->hasMany(TransaksiPeminjam::class, 'dtl_buku_id');
    }

    public function createdUser(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}