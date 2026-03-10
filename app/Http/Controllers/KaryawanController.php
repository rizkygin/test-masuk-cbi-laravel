<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        // dd('hai');
        $data['selectDepartemen'] = Departemen::all();
        $data['selectJabatan'] = Jabatan::all();

        return inertia('karyawan/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekaryawanRequest $request)
    {


        $user = User::create([
            'name' => $request->nama,
            'email' => fake()->email,
            'password' => Hash::make($request->password),
        ]);
        $karyawan = karyawan::create([
            'nama' => $request->nama,
            'departemen_id' => $request->departemen,
            'jabatan_id' => $request->jabatan,
            'user_id' => $user->id
        ]);

        return redirect()->route('karyawan.show', $karyawan->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(karyawan $karyawan)
    {
        // dd($karyawan);
        // $karyawan = karyawan::find($karyawan);
        // dd($karyawan);?
        // $data['karyawan'] = karyawan::with('departemen', 'jabatan')->get()->where('id', $karyawan->id);
        $data['karyawan'] = $karyawan;
        // dd($data['karyawan']);
        $data['departemen'] = $karyawan->departemen;
        $data['jabatan'] = $karyawan->jabatan;

        $data['selectDepartemen'] = Departemen::all();
        $data['selectJabatan'] = Jabatan::all();

        // dd($data['departemen']);
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
    public function update(UpdatekaryawanRequest $request, karyawan $karyawan)
    {
        // dd($request->all());
        // dd(karyawan::find($id));
        // $karyawan = karyawan::find($id);
        // dd($karyawan);

        $karyawan->nama = $request->nama;
        $karyawan->jabatan_id = $request->jabatan;
        $karyawan->departemen_id = $request->departemen;

        // dd($karyawan);
        $karyawan->save();
        return $this->show($karyawan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $karyawan = karyawan::find($id);
        $karyawan->delete();
        return redirect('/karyawan')->with('status', 'success');
    }
}