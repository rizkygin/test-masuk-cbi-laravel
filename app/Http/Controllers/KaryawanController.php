<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\karyawan;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $returnData = [];
        $data['karyawan'] = karyawan::with('jabatan', 'departemen')->get();
        foreach ($data['karyawan'] as $karyawan) {
            $returnData['karyawan'][] = [
                'id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'jabatan' => $karyawan->jabatan->nama,
                'departemen' => $karyawan->departemen->nama,
            ];
        }
        return inertia('karyawan/index', $returnData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekaryawanRequest $request)
    {
    //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        $karyawan = karyawan::find($id);
        // $data['karyawan'] = karyawan::with('departemen', 'jabatan')->get()->where('id', $id);
        $data['karyawan'] = $karyawan;
        $data['departemen'] = $karyawan->departemen;
        $data['jabatan'] = $karyawan->jabatan;

        $data['selectDepartemen'] = Departemen::all();
        $data['selectJabatan'] = Jabatan::all();

        // dd($data['jabatan']);
        return inertia('karyawan/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(karyawan $karyawan)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekaryawanRequest $request, $id)
    {
        // dd($request->all());
        // dd(karyawan::find($id));
        $karyawan = karyawan::find($id);

        $karyawan->nama = $request->nama;
        $karyawan->jabatan_id = $request->jabatan;
        $karyawan->departemen_id = $request->departemen;

        // dd($karyawan);
        $karyawan->save();
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = karyawan::find($id);
        // return dd($karyawan);
        $karyawan->delete();
        return redirect('/karyawan')->with('status', 'success');
    }
}