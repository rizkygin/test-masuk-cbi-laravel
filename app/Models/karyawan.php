<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Roster\Package;

class karyawan extends Model
{
    /** @use HasFactory<\Database\Factories\KaryawanFactory> */
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'nama',
        'jabatan_id',
        'departemen_id',
        'user_id'
    ];

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class , 'departemen_id');
    }
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class , 'jabatan_id');
    }
}