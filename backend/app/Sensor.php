<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'perusahaan_id',
        'site_id',
        'kode',
        'nama',
        'keterangan',
        'satuan',
        'nilai_minimum',
        'nilai_maximum',
        'nilai_tinggi',
        'nilai_rendah',
        'jenis_chart',
        'status'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function logs()
    {
        return $this->hasMany(SensorLog::class);
    }
}
