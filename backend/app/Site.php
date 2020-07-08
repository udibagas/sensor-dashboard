<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = ['perusahaan_id', 'kode', 'nama', 'keterangan', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }
}
