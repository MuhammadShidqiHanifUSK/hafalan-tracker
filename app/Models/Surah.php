<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    protected $fillable = [
        'nomor',
        'nama_arab',
        'nama_latin',
        'jumlah_ayat',
    ];

    public function sabaq()
    {
        return $this->hasMany(Sabaq::class);
    }

    public function sabqi()
    {
        return $this->hasMany(Sabqi::class);
    }

    public function manzil()
    {
        return $this->hasMany(Manzil::class);
    }
}