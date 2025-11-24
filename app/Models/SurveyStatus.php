<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyStatus extends Model
{
    protected $table = 'survey_status';

    protected $fillable = [
        'warga_id',
        'pendapatan',
        'pekerjaan',
        'kondisi_rumah',
        'jumlah_anggota',
        'kwh_listrik',
        'foto',
        'klasifikasi',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
