<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIzinRequest;
use App\Http\Requests\UpdateIzinRequest;
use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $karyawan = Auth()->user()->karyawan;
        $data['izin'] = Izin::all()->where('karyawan_id', $karyawan->id);
        // dd($data);
        $returnData = [];

        foreach ($data['izin'] as $izin) {
            $returnData['izin'][] = [
                'id' => $izin->id,
                'tanggal' => $izin->tanggal,
                'keterangan' => $izin->keterangan,
                'status' => $izin->status,
                'disetujui_oleh' => $izin->disetujui_oleh
            ];
        }
        return inertia('izin/index', $returnData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $karyawan = Karyawan::all();
        return inertia('izin/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIzinRequest $request)
    {
        // dd($request->all());
        // $izin = Izin::create($request->all());
        $karyawan = Auth()->user()->karyawan;
        $izin = Izin::create([
            'karyawan_id' => $karyawan->id,
            'keterangan' => $request->jenis_izin,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('izinTidakMasukCreate');
    // return inertia('izin/create');

    }

    /**
     * Display the specified resource.
     */
    public function show(Izin $izin)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Izin $izin)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIzinRequest $request, Izin $izin)
    {
        $izin->disetujui_oleh = Auth()->user()->karyawan->id;
        $izin->status = $request->status;
        $izin->save();
        $data['session'] = "Success Diberikan Izin";
        return inertia('dashboard/index', $data)->with('session', $data['session']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Izin $izin)
    {
    //
    }
}