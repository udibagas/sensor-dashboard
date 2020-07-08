<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
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

    public function logs()
    {
        return $this->hasMany(SensorLog::class);
    }
}
