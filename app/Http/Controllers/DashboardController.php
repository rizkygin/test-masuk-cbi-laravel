<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\User;
use App\Models\Izin;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $data['karyawan'] = karyawan::all()->count();
        $data['user'] = User::all()->count();

        $dataIzinPending = Izin::all()->where('status', 'pending')->where('tanggal', date('Y-m-d'));
        $data['izin'] = $dataIzinPending->count();
        $data['dataIzin'] = [];
        foreach ($dataIzinPending as $izin) {
            $data['dataIzin'][] = [
                'id' => $izin->id,
                'karyawan' => $izin->karyawan->nama,
                'tanggal' => $izin->tanggal,
                'keterangan' => $izin->keterangan,
                'alasan' => $izin->alasan,
                'status' => $izin->status,
                'disetujui_oleh' => $izin->disetujui_oleh
            ];
        }
        return inertia('dashboard/dashboard', $data);

    }
}