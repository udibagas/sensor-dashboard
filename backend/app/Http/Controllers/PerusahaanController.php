<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerusahaanRequest;
use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Perusahaan::when($request->keyword, function ($q) use ($request) {
            return $q->where(function ($x) use ($request) {
                $x->where('kode', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nama', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('alamat', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('fax', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('email', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('website', 'LIKE', "%{$request->keyword}%");
            });
        })->when($request->status, function ($q) use ($request) {
            $status = is_array($request->status) ? (int) $request->status[0] : (int) $request->status;
            return $q->where('status', (int) $status);
        })
            ->orderBy($request->sort ?: 'nama', $request->order == 'ascending' ? 'asc' : 'desc')
            ->paginate($request->pageSize);

        return [
            'total' => $data->total(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
            'data' => $data->items()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerusahaanRequest $request)
    {
        $perusahaan = Perusahaan::create($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $perusahaan
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        return $perusahaan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(PerusahaanRequest $request, Perusahaan $perusahaan)
    {
        $perusahaan->update($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $perusahaan
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();

        return ['message' => 'Data telah dihapus'];
    }

    public function getList(Request $request)
    {
        return Perusahaan::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get()
            ->toArray();
    }
}
