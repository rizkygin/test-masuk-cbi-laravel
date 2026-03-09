<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    /** @use HasFactory<\Database\Factories\IzinFactory> */
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'alasan',
        'keterangan',
        'status',
        'disetujui_oleh',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class , 'karyawan_id', 'id');
    }
    public function disetujuiOleh()
    {
        return $this->belongsTo(Karyawan::class , 'disetujui_oleh', 'id');
    }
}