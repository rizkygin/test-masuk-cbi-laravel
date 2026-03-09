<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartemenRequest;
use App\Http\Requests\UpdateDepartemenRequest;
use App\Models\Departemen;
use App\Models\karyawan;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemens = Departemen::all();
        $data['data'] = [];
        foreach ($departemens as $departemen) {
            $data['data'][] = [
                'id' => $departemen->id,
                'departemen' => $departemen->nama
            ];
        }
        return inertia('departemen/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return inertia('departemen/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartemenRequest $request)
    {
        // dd($request->all());
        Departemen::create([
            'nama' => $request->name
        ]);

        return route('kelolaDepartemen');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departemen $departemen)
    {
        $data['departemen'] = $departemen;
        return inertia('departemen/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departemen $departemen)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartemenRequest $request, Departemen $departemen)
    {
        // dd($departemen);
        $departemen->nama = $request->name;
        $departemen->save();
        return route('kelolaDepartemen');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        // dd($departemen);
        $departemens = karyawan::where('departemen_id', $departemen->id)->count();

        if ($departemens > 0) {
            return;
        }
        $departemen->delete();
        // dd($departemen);
        return route('kelolaDepartemen');
    }
}