<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitoringPerkembangan extends Model
{
    use HasFactory;

    protected $table = 'monitoring_perkembangans';
    protected $fillable = [
        'pendaftaran_id',
        'guru_id',
        'kegiatan',
        'deskripsi',
        'foto',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}