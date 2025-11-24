<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingSurat extends Model
{
    use HasFactory;

    protected $table = 'tracking_surats';

    protected $fillable = [
        'surat_id',
        'status',
        'tanggal_update',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }
}
