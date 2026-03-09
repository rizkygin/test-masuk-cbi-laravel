<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Http\Resources\PermitResource;

class PermitApiController extends Controller
{
    public function index()
    {
        return new PermitResource(Izin::all());
    }
    public function show($id)
    {
        $izin = Izin::find($id);
        if (!$izin) {
            return response()->json([
                'message' => 'Izin tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'message' => 'Berhasil',
            'data' => $izin
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'tanggal' => 'required',
            'alasan' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'disetujui_oleh' => 'required',
        ]);
        $izin = Izin::create([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'disetujui_oleh' => $request->disetujui_oleh,
        ]);
        return response()->json([
            'message' => 'berhasil buat Izin',
            'data' => $izin
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $izin = Izin::find($id);
        if (!$izin) {
            return response()->json([
                'message' => 'Izin tidak ditemukan',
            ], 404);
        }
        $request->validate([
            'karyawan_id' => 'required',
            'tanggal' => 'required',
            'alasan' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
            'disetujui_oleh' => 'required',
        ]);
        $izin->update([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'disetujui_oleh' => $request->disetujui_oleh,
        ]);
        return response()->json([
            'message' => 'Berhasil Update Izin',
            'data' => $izin
        ], 200);
    }
    public function destroy($id)
    {
        $izin = Izin::find($id);
        if (!$izin) {
            return response()->json([
                'message' => 'Izin tidak ditemukan',
            ], 404);
        }
        $izin->delete();
        return response()->json([
            'message' => 'Berhasil menghapus Izin',
        ], 200);
    }
}