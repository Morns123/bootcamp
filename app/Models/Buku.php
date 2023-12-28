<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'mst_buku';
    protected $guarded = ['id'];

    public function penulis() {
        return $this->belongsToMany(Penulis::class, 'penulis_buku', 'buku_id', 'penulis_id');
    }
    public function penerbit() {
        return $this->belongsTo(Penerbit::class);
    }

    public function detailBukus() {
        return $this->hasMany(DetailBuku::class, 'buku_id');
    }

        // public function peminjamans() {
        //     return $this->hasMany(TransaksiPeminjaman::class, 'buku_id');
        // }

    public function createdUser(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}