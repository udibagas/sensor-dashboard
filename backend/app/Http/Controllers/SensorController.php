<?php

namespace App\Http\Controllers;

use App\Http\Requests\SensorRequest;
use App\Http\Resources\SensorCollection;
use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Sensor::when($request->keyword, function ($q) use ($request) {
            return $q->where(function ($x) use ($request) {
                $x->where('kode', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nama', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('keterangan', 'LIKE', "%{$request->keyword}%");
            });
        })->when($request->site_id, function ($q) use ($request) {
            $site = is_array($request->site_id) ? $request->site_id : [$request->site_id];
            return $q->whereIn('site_id', $site);
        })->when($request->status, function ($q) use ($request) {
            $status = is_array($request->status) ? (int) $request->status[0] : (int) $request->status;
            return $q->where('status', (int) $status);
        })
            ->orderBy($request->sort ?: 'nama', $request->order == 'ascending' ? 'asc' : 'desc')
            ->paginate($request->pageSize);

        return new SensorCollection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SensorRequest $request)
    {
        $sensor = Sensor::create($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $sensor
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        return $sensor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(SensorRequest $request, Sensor $sensor)
    {
        $sensor->update($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $sensor
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();

        return ['message' => 'Data telah dihapus'];
    }

    public function getList(Request $request)
    {
        return Sensor::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get()
            ->toArray();
    }
}
