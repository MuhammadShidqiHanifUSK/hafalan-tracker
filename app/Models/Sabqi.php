<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabqi extends Model
{
    protected $fillable = [
        'setoran_id',
        'surah_id',
        'ayat_mulai',
        'ayat_selesai',
        'jumlah_halaman',
        'nilai',
    ];

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}