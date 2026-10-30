<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'nama', 'email', 'password', 'role', 'foto_profil', 'bio', 'username', 'status_akun'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function karyas() { return $this->hasMany(Karya::class, 'id_users', 'id'); }
    public function events() { return $this->hasMany(Event::class, 'id_users', 'id'); }
    public function pendaftaranEvents() { return $this->hasMany(PendaftaranEvent::class, 'id_users', 'id'); }
    public function interaksis() { return $this->hasMany(Interaksi::class, 'id_users', 'id'); }
    public function interaksiDiterima() { return $this->hasMany(Interaksi::class, 'id_target_users', 'id'); }
}