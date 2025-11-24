<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusKeluarga extends Model
{
    protected $table = 'status_keluargas'; // nama tabel di DB
    protected $fillable = ['klasifikasi', 'deskripsi'];

    public function warga()
    {
        return $this->hasMany(Warga::class, 'status_keluarga_id');
    }
}
