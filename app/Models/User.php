<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool hasRole(string|array $roles)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Guru: perkembangan yang dibuat
    public function perkembanganDibuat()
    {
        return $this->hasMany(MonitoringPerkembangan::class, 'guru_id');
    }

    // Orang tua: perkembangan anaknya (via pendaftaran)
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'user_id');
    }
}