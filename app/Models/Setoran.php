<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $table = 'setoran';
    
    protected $fillable = [
        'user_id',
        'tanggal',
        'paraf_guru',
        'paraf_ortu',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function catatanSetoran()
    {
        return $this->hasMany(CatatanSetoran::class);
    }
}