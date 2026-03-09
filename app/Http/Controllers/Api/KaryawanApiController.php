<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Http\Resources\KaryawanResource;
use Illuminate\Http\Request;

class KaryawanApiController extends Controller
{
    public function index()
    {
        return new KaryawanResource(Karyawan::all());
    }
    public function show($id)
    {
        // dd($karyawan);
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Karyawan created successfully',
            'data' => new KaryawanResource($karyawan)
        ], 201);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan_id' => 'required',
            'departemen_id' => 'required',
            'user_id' => 'required',
        ]);
        $karyawan = Karyawan::create([
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'departemen_id' => $request->departemen_id,
            'user_id' => $request->user_id,
        ]);
        return new KaryawanResource($karyawan);
    }
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::find($id);
        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan not found',
            ], 404);
        }
        $karyawan->update([
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'departemen_id' => $request->departemen_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json([
            'message' => 'Karyawan created successfully',
            'data' => new KaryawanResource($karyawan)
        ], 201);
    }
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return response()->json(null, 204);
    }
}