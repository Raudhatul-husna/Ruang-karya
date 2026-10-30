<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karya extends Model
{
    protected $fillable = ['id_users', 'judul', 'deskripsi', 'lorong', 'file_karya', 'isi_teks', 'status'];

    public function user() { return $this->belongsTo(User::class, 'id_users', 'id'); }
    public function interaksis() { return $this->hasMany(Interaksi::class, 'id_karya', 'id'); }
}