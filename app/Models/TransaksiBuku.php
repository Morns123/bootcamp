<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBuku extends Model
{
    use HasFactory;

    protected $table = 'trx_buku';

    protected $guarded = ['id'];

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function dtlBuku(){
        return $this->belongsTo(DetailBuku::class, 'dtl_buku_id');
    }

    public function dtlBukusByIn(){
        return $this->hasMany(DetailBuku::class, 'trx_in_id');
    }
}