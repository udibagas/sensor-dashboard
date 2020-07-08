<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'kode', 'nama', 'alamat', 'telp', 'fax', 'email', 'website', 'status'
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }
}
