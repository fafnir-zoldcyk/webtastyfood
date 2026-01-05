<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $guarded = [];
    public function komentar()
    {
        return $this->hasMany(Komentar::class,'berita_id');
    }
}
