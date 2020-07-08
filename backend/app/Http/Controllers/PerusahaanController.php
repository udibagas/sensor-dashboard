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
        return Perusahaan::paginate($request->pageSize);
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
