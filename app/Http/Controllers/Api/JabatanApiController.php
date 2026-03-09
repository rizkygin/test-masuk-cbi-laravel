<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\karyawan;
use App\Http\Resources\JabatanResource;

class JabatanApiController extends Controller
{
    public function index()
    {
        return new JabatanResource(Jabatan::all());
    }
    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return new JabatanResource($jabatan);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $jabatan = Jabatan::create([
            'nama' => $request->nama,
        ]);
        return response()->json([
            'message' => 'Jabatan created successfully',
            'data' => $jabatan,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $request->validate([
            'nama' => 'required',
        ]);
        $jabatan->update([
            'nama' => $request->nama,
        ]);
        return response()->json([
            'message' => 'Jabatan updated successfully',
            'data' => $jabatan,
        ], 200);
    }
    public function destroy($id)
    {
        if (karyawan::where('jabatan_id', $id)->exists()) {
            return response()->json([
                'message' => 'Jabatan cannot be deleted, Pastikan tidak ada karyawan yang menggunakan jabatan ini',
            ], 400);
        }
        $jabatan = Jabatan::findOrFail($id);
        if (!$jabatan) {
            return response()->json([
                'message' => 'Jabatan not found',
            ], 404);
        }
        $jabatan->delete();
        return response()->json(null, 204);
    }
}