<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    protected $guarded = [];
    public function tentang()
    {
        return $this->hasMany(Tentang::class, 'gambar_id');
    }
}
