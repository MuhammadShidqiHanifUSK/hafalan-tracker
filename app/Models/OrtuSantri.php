<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrtuSantri extends Model
{
    protected $table = 'ortu_santri';

    protected $fillable = [
        'ortu_id',
        'santri_id',
    ];

    public function ortu()
    {
        return $this->belongsTo(User::class, 'ortu_id');
    }

    public function santri()
    {
        return $this->belongsTo(User::class, 'santri_id');
    }
}