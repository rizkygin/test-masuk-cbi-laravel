<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorekaryawanRequest;
use App\Http\Requests\UpdatekaryawanRequest;
use App\Models\karyawan;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'karyawan' => karyawan::all(),
        ];
        return inertia('karyawan/index', $data);
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
    public function show(karyawan $karyawan)
    {
    //
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
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(karyawan $karyawan)
    {
    //
    }
}