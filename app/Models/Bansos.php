<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    protected $table = 'bansos';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'nama_program',
        'deskripsi',
        'kriteria',
    ];

    public function penerima_bansos()
    {
        return $this->hasMany(PenerimaBansos::class);
    }
}