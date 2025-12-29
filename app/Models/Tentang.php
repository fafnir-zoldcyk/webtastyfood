<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $guarded = [];
    public function gambar(){
        return $this->belongsTo(Gambar::class,'gambar_id');
    }
}
