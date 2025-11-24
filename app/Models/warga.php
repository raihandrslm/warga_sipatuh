<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Warga extends Authenticatable
{
    protected $table = 'wargas';

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'status',
        'status_keluarga_id',
    ];

    public function status_keluarga()
    {
        return $this->belongsTo(StatusKeluarga::class, 'status_keluarga_id');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'warga_id');
    }

    public function surveyStatus()
    {
        return $this->belongsTo(SurveyStatus::class, 'survey_status_id');
    }

    public function penerima_bansos()
    {
        return $this->hasMany(PenerimaBansos::class);
    }
}
