<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy($request->order ?: 'name', $request->sort == 'ascending' ? 'asc' : 'desc')
            ->when($request->keyword, function ($q) use ($request) {
                return $q->where('name', 'LIKE', $request->keyword);
            })->when($request->perusahaan_id, function ($q) use ($request) {
                return $q->whereIn('perusahaan_id', $request->perusahaan_id);
            })->when($request->site_id, function ($q) use ($request) {
                return $q->whereIn('site_id', $request->site_id);
            })->paginate($request->pageSize);

        return [
            'total' => $data->total(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
            'data' => $data->map(function ($d) {
                return array_merge($d->toArray(), [
                    'perusahaan' => $d->perusahaan ? $d->perusahaan->nama : '',
                    'site' => $d->site ? $d->site->nama : '',
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
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $user
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        return [
            'message' => 'Data telah disimpan',
            'data' => $user
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return ['message' => 'Data telah dihapus'];
    }

    public function getList(Request $request)
    {
        return User::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();
    }

    public function getRoleList()
    {
        return User::roleList();
    }
}
