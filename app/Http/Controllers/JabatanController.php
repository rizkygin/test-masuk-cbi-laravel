<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;
use App\Models\Jabatan;
use App\Models\karyawan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jabatans'] = Jabatan::all();
        $data['data'] = [];
        foreach ($data['jabatans'] as $jabatan) {
            $data['data'][] = [
                'id' => $jabatan->id,
                'jabatan' => $jabatan->nama,
            ];
        }
        return inertia('jabatan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return inertia('jabatan/create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJabatanRequest $request)
    {
        Jabatan::create([
            'nama' => $request->name
        ]);
        return route('kelolaJabatan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        $data['data'] = $jabatan;
        return inertia('jabatan/show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJabatanRequest $request, Jabatan $jabatan)
    {
        $jabatan->nama = $request->name;
        $jabatan->save();

        return route('kelolaJabatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        if (karyawan::all()->where('jabatan_id', $id)->count() > 0) {
            return;
        }
        $jabatan->delete();
        return route('kelolaJabatan');
    }
}