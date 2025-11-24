<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiIuran extends Model
{
    protected $table = 'transaksi_iurans';
    protected $fillable = [
        'warga_id',
        'iuran_id',
        'jumlah_bayar',
        'status_bayar',
        'tanggal',
    ];

    /**
     * Relasi ke model Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    /**
     * Relasi ke model Iuran
     */
    public function iuran()
    {
        return $this->belongsTo(Iuran::class);
    }
}