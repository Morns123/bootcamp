<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjam extends Model
{
    use HasFactory;

    protected $table = 'trx_peminjaman';

    protected $guarded = ['id'];
}
