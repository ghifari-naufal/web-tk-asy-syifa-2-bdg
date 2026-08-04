<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftarans';

    protected $fillable = [
        'user_id',
        'nama_ortu',
        'no_hp',
        'nama_anak',
        'kelas_tk',
        'email_login',
        'password_login',
        // Dokumen Pembayaran
        'file_title',
        'file_path',
        'file_type',
        'file_size',
        // Dokumen Persyaratan (KK, Akta, KTP)
        'dokumen_persyaratan_title',
        'dokumen_persyaratan_path',
        'dokumen_persyaratan_type',
        'dokumen_persyaratan_size',
        'status',
        'catatan',
    ];

    // Helper methods untuk file
    public function hasFile()
    {
        return !empty($this->file_path) && !empty($this->file_type);
    }

    public function isImage()
    {
        return $this->file_type === 'image';
    }

    public function isPdf()
    {
        // Cek apakah file_type adalah document dan extensinya PDF
        return $this->file_type === 'document' && 
               $this->file_path && 
               strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION)) === 'pdf';
    }

    public function isWord()
    {
        // Cek apakah file_type adalah document dan extensinya Word
        return $this->file_type === 'document' && 
               $this->file_path && 
               in_array(strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION)), ['doc', 'docx']);
    }

    // Helper methods untuk dokumen persyaratan
    public function hasDokumenPersyaratan()
    {
        return !empty($this->dokumen_persyaratan_path) && !empty($this->dokumen_persyaratan_type);
    }

    public function isDokumenPersyaratanImage()
    {
        return $this->dokumen_persyaratan_type === 'image';
    }

    public function isDokumenPersyaratanPdf()
    {
        // Cek apakah dokumen_persyaratan_type adalah document dan extensinya PDF
        return $this->dokumen_persyaratan_type === 'document' && 
               $this->dokumen_persyaratan_path && 
               strtolower(pathinfo($this->dokumen_persyaratan_path, PATHINFO_EXTENSION)) === 'pdf';
    }

    public function isDokumenPersyaratanWord()
    {
        // Cek apakah dokumen_persyaratan_type adalah document dan extensinya Word
        return $this->dokumen_persyaratan_type === 'document' && 
               $this->dokumen_persyaratan_path && 
               in_array(strtolower(pathinfo($this->dokumen_persyaratan_path, PATHINFO_EXTENSION)), ['doc', 'docx']);
    }

    public function getFileTypeIcon()
    {
        if (!$this->hasFile()) {
            return 'fas fa-file-times text-gray-400';
        }

        switch ($this->file_type) {
            case 'image':
                return 'fas fa-image text-blue-500';
            case 'document':
                // Cek extension untuk menentukan icon yang lebih spesifik
                if ($this->file_path) {
                    $extension = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));
                    if ($extension === 'pdf') {
                        return 'fas fa-file-pdf text-red-500';
                    } elseif (in_array($extension, ['doc', 'docx'])) {
                        return 'fas fa-file-word text-blue-600';
                    }
                }
                return 'fas fa-file-alt text-gray-500';
            default:
                return 'fas fa-file text-gray-500';
        }
    }

    public function getDokumenPersyaratanTypeIcon()
    {
        if (!$this->hasDokumenPersyaratan()) {
            return 'fas fa-exclamation-triangle text-red-400';
        }

        switch ($this->dokumen_persyaratan_type) {
            case 'image':
                return 'fas fa-image text-blue-500';
            case 'document':
                // Cek extension untuk menentukan icon yang lebih spesifik
                if ($this->dokumen_persyaratan_path) {
                    $extension = strtolower(pathinfo($this->dokumen_persyaratan_path, PATHINFO_EXTENSION));
                    if ($extension === 'pdf') {
                        return 'fas fa-file-pdf text-red-500';
                    } elseif (in_array($extension, ['doc', 'docx'])) {
                        return 'fas fa-file-word text-blue-600';
                    }
                }
                return 'fas fa-file-alt text-gray-500';
            default:
                return 'fas fa-file text-gray-500';
        }
    }

    public function getFormattedFileSize()
    {
        if (!$this->file_size) return '-';
        
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFormattedDokumenPersyaratanSize()
    {
        if (!$this->dokumen_persyaratan_size) return '-';
        
        $bytes = $this->dokumen_persyaratan_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getStatusBadge()
    {
        switch ($this->status) {
            case 'approved':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i> Disetujui
                </span>';
            case 'rejected':
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                </span>';
            default:
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-clock mr-1"></i> Menunggu
                </span>';
        }
    }

    // Scope untuk filter status
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perkembangan()
    {
        return $this->hasMany(MonitoringPerkembangan::class);
    }
}