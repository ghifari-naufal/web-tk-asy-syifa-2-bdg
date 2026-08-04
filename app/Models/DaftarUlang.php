<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    use HasFactory;

    protected $table = 'daftar_ulang';

    protected $fillable = [
        'user_id',
        'tahun_ajaran',
        'biaya_daftar_ulang',
        'bukti_pembayaran',
        'tanggal_daftar'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'biaya_daftar_ulang' => 'decimal:2'
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk tahun ajaran tertentu
    public function scopeTahunAjaran($query, $tahunAjaran)
    {
        return $query->where('tahun_ajaran', $tahunAjaran);
    }
}