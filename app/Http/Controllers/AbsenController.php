<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;
use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateTimeZone;

class AbsenController extends Controller
{

    public function index()
    {
        $returnData['absen'] = Absen::all();
        // $returnData['karyawan'] = karyawan::all();

        $returnData['data'] = [];
        foreach (Absen::all() as $absen) {
            // dd($absen->karyawan->departemen->nama);
            $returnData['data'][] = [
                'id' => $absen->id,
                'tanggal' => $absen->tanggal,
                'jam_masuk' => $absen->jam_masuk,
                'jam_pulang' => $absen->jam_pulang,
                'status' => $absen->status,
                'karyawan' => $absen->karyawan->nama,
                'departemen' => $absen->karyawan->departemen->nama,
                'jabatan' => $absen->karyawan->jabatan->nama
            ];
        }
        return inertia('absen/index', $returnData);
    }
    /**
     * Display a listing of the resource.
     */
    public function absenPagi()
    {
        // dd('test');
        $data['absen'] = Absen::all();

        $karyawan_id = Auth()->user()->karyawan->id;
        $tanggal = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $lastAbsent = $data['absen']->where('karyawan_id', $karyawan_id)->where('tanggal', $tanggal)->last();
        $yesterdayAbsent = $data['absen']->where('karyawan_id', $karyawan_id)->where('tanggal', $yesterday)->last();
        @$data['lastAbsent'] = $lastAbsent->jam_masuk;
        @$data['yesterdayAbsent'] = $yesterdayAbsent->jam_masuk;
        return inertia('absen/absenpagi', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function absenPulang()
    {
        $data['absen'] = Absen::all();

        $data['absen'] = Absen::all();

        $karyawan_id = Auth()->user()->karyawan->id;
        $tanggal = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $lastAbsent = $data['absen']->where('karyawan_id', $karyawan_id)->where('tanggal', $tanggal)->last();
        $yesterdayAbsent = $data['absen']->where('karyawan_id', $karyawan_id)->where('tanggal', $yesterday)->last();
        @$data['lastAbsent'] = $lastAbsent->jam_pulang;
        @$data['yesterdayAbsent'] = $yesterdayAbsent;
        @$absenPagi = Absen::all()->where('tanggal', $tanggal)->where('karyawan_id', $karyawan_id)->first();
        @$data['absenPagi'] = @$absenPagi;

        return inertia('absen/absenpulang', $data);
    }

    public function absenPagiStore(StoreAbsenRequest $request)
    {
        $user = Auth()->user();
        $tanggal = date('Y-m-d');
        $time = new DateTime();
        $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $waktuAbsen = $time->format('H:i:s');

        $waktu_telat = '08:01:00';

        $waktu_telat = new DateTime($waktu_telat, new DateTimeZone('Asia/Jakarta'));


        $interval = date_diff($time, $waktu_telat);
        $interval = $interval->format('%R');
        $status = 'Masuk';
        if ($interval === "-") {
            $status = 'Telat';
        }

        $data = Absen::create([
            'karyawan_id' => $user->karyawan->id,
            'tanggal' => date('Y-m-d'),
            'jam_masuk' => $waktuAbsen,
            'status' => $status,
        ]);
        return redirect()->route('absenPagi');
    }

    public function absenPulangStore(StoreAbsenRequest $request)
    {
        $user = Auth()->user()->karyawan;
        // $tanggal = new DateTime();
        $tanggal = date('Y-m-d');

        @$absen = Absen::all()->where('tanggal', $tanggal)->where('karyawan_id', $user->id)->first();

        // $absen->insert
        $time = new DateTime();
        $time->setTimezone(new DateTimeZone('Asia/Jakarta'));
        $absen->update([
            'jam_pulang' => $time->format('H:i:s'),
        ]);

        return redirect()->route('absenPulang');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenRequest $request)
    {
    //
    }

    /**
     * Display the specified resource.
     */
    public function show(Absen $absen)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absen $absen)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absen $absen)
    {
    //
    }
}