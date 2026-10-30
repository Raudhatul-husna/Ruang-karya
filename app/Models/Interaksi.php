<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $id_users
 * @property int|null $id_karya
 * @property int|null $id_event
 * @property int|null $id_target_users
 * @property string $jenis_interaksi
 * @property string|null $isi_interaksi
 * @property string|null $tipe_komentar
 */
class Interaksi extends Model
{
    protected $fillable = [
        'id_users',
        'id_karya',
        'id_event',
        'id_target_users',
        'jenis_interaksi',
        'isi_interaksi',
        'tipe_komentar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_target_users', 'id');
    }

    public function karya(): BelongsTo
    {
        return $this->belongsTo(Karya::class, 'id_karya', 'id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'id_event', 'id');
    }
}