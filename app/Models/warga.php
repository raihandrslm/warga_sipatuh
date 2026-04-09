<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Warga extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'wargas';

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'status',
        'status_keluarga_id',
    ];

    protected $hidden = [
        // kalau ada password atau sensitive data, taruh di sini
    ];

    // === PENTING: Karena kamu tidak pakai password ===
    public function getAuthPassword()
    {
        // Kalau login tidak pakai password, override ini
        return null; // atau return $this->password kalau ada kolom password
    }

    // Opsional: Tentukan kolom apa yang dipakai sebagai "username" untuk auth
    public function getAuthIdentifierName()
    {
        return 'nik';   // atau 'id' kalau mau pakai primary key
    }

    // Relasi-relasi kamu sudah bagus
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