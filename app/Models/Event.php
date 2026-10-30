<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $id_users
 * @property string $judul_event
 * @property string|null $deskripsi
 * @property string|null $lokasi
 * @property string $tanggal_mulai
 * @property string $tanggal_selesai
 * @property string|null $tanggal_buka_daftar
 * @property string|null $tanggal_tutup_daftar
 * @property string $status
 */
class Event extends Model
{
    
protected $casts = [
    'rundown' => 'array',
];

protected $fillable = [
    'id_users',
    'judul_event',
    'deskripsi',
    'lokasi',
    'tanggal_mulai',
    'tanggal_selesai',
    'tanggal_buka_daftar',
    'tanggal_tutup_daftar',
    'status',
    'rundown',
];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function pendaftaranEvents(): HasMany
    {
        return $this->hasMany(PendaftaranEvent::class, 'id_event', 'id');
    }

    public function interaksis(): HasMany
    {
        return $this->hasMany(Interaksi::class, 'id_event', 'id');
    }
}