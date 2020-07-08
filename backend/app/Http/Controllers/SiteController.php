<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Site::when($request->keyword, function ($q) use ($request) {
            return $q->where(function ($x) use ($request) {
                $x->where('kode', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('nama', 'LIKE', "%{$request->keyword}%")
                    ->orWhere('keterangan', 'LIKE', "%{$request->keyword}%");
            });
        })->when($request->perusahaan_id, function ($q) use ($request) {
            $perusahaan = is_array($request->perusahaan_id) ? $request->perusahaan_id : [$request->perusahaan_id];
            return $q->whereIn('perusahaan_id', $perusahaan);
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
            'data' => $data->map(function ($d) {
                return array_merge($d->toArray(), [
                    'perusahaan' => $d->perusahaan->nama,
                ]);
            })
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteRequest $request)
    {
        $site = Site::create($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $site
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        return $site;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $site
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();

        return ['message' => 'Data telah dihapus'];
    }

    public function getList(Request $request)
    {
        return Site::select('id', 'nama')
            ->orderBy('nama', 'asc')
            ->get()
            ->toArray();
    }
}
