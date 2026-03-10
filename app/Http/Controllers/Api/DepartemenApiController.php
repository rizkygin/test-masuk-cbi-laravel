<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\karyawan;
use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Http\Resources\DepartemenResource;

class DepartemenApiController extends Controller
{
    public function index()
    {
        return new DepartemenResource(Departemen::all());
    }
    public function show($id)
    {
        // dd($id);
        $departemen = Departemen::find($id);
        return response()->json([
            'data' => $departemen
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $departemen = Departemen::create([
            'nama' => $request->nama,
        ]);
        return new DepartemenResource($departemen);
    }
    public function update(Request $request, $id)
    {
        // dd($id);

        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'message' => 'Departemen Not Found'
            ], 203);
        }
        $departemen->update([
            'nama' => $request->nama,
        ]);
        return response()->json([
            'message' => 'Berhasil mengubah Departemen',
            'data' => $departemen
        ]);
    }
    public function destroy($id)
    {
        $departemen = Departemen::find($id);
        $departemen->delete();
        if (karyawan::where('departemen', $id)->exists()) {
            return response()->json([
                'message' => 'Departemen cannot be deleted, Pastikan tidak ada karyawan yang menggunakan jabatan ini',
            ], 400);
        }
        if (!$departemen) {
            return response()->json([
                'message' => 'Jabatan not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Berhasil dihapus'
        ]);
    }
}