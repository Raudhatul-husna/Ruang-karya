<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_users
 * @property int $id_event
 * @property string|null $tanggal_daftar
 * @property string $status_pendaftaran
 */
class PendaftaranEvent extends Model
{
    protected $fillable = ['id_users', 'id_event', 'tanggal_daftar', 'status_pendaftaran'];

    public function user() { return $this->belongsTo(User::class, 'id_users', 'id'); }
    public function event() { return $this->belongsTo(Event::class, 'id_event', 'id'); }
}