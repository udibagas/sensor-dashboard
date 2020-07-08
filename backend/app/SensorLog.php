<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    protected $fillable = ['sensor_id', 'waktu', 'nilai'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
