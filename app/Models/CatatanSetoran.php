<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanSetoran extends Model
{
    protected $fillable = [
        'setoran_id',
        'user_id',
        'role',
        'isi_catatan',
    ];

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}