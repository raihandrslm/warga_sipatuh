<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $table = 'iurans';
    protected $fillable = ['nama_iuran','deskripsi','harga',];

    public function iuran()
    {
        return $this->hasMany(TransaksiIuran::class, 'transaksi_iuran_id');
    }
}