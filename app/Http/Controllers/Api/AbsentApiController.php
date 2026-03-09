<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absen;
use App\Http\Resources\AbsenResource;

class AbsentApiController extends Controller
{
    public function index()
    {
        return new AbsenResource(Absen::all());
    }
    public function show($id)
    {
        $absent = Absen::find($id);
        if (!$absent) {
            return response()->json([
                'message' => 'Absent tidak ditemukan',
            ], 400);
        }
        return response()->json([
            'message' => 'berhasil',
            'data' => $absent
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'tanggal' => 'required',
        ]);
        $absen = Absen::create([
            'karyawan_id' => $request->karyawan_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'berhasil Buat Absen',
            'data' => $absen
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'tanggal' => 'required',
        ]);
        $absen = Absen::find($id);
        // dd($absen);
        $absen->update([
            'karyawan_id' => $request->karyawan_id,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'Berhasil Update Absent',
            'data' => $absen
        ], 200);
    }
    public function destroy(Absen $absen)
    {
        $absen->delete();
        return response()->json(null, 204);
    }
}