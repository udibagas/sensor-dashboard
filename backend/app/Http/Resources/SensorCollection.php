<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SensorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($d) {
                return array_merge($d->toArray(), [
                    'perusahaan' => $d->perusahaan->nama,
                    'site' => $d->site->nama,
                ]);
            })
        ];
    }
}
