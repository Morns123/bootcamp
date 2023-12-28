<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjam extends Model
{
    use HasFactory;

    protected $table = 'trx_peminjaman';

    protected $guarded = ['id'];

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function detailBuku(){
        return $this->belongsTo(DetailBuku::class, 'dtl_buku_id');
    }

    public function createdUser(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
