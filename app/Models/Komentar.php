<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $guarded = [];
     
    public function berita()
    {
        return $this->belongsTo(Berita::class,'berita_id');
    }
}
