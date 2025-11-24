<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model
{
    use HasFactory;

    protected $table = 'penerima_bansos';

    protected $fillable = [
        'warga_id',
        'bansos_id',
        'tanggal_terima',
        'status',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    public function bansos()
    {
        return $this->belongsTo(Bansos::class, 'bansos_id');
    }
}