<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sabaq extends Model
{
    protected $fillable = [
        'setoran_id',
        'surah_id',
        'ayat_mulai',
        'ayat_selesai',
        'jumlah_baris',
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