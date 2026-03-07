<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Pemasaran, HRD, Keuangan, Produksi, dan IT
        Departemen::create([
            'nama' => 'Pemasaran'
        ]);
        Departemen::create([
            'nama' => 'HRD'
        ]);
        Departemen::create([
            'nama' => 'Keuangan'
        ]);
        Departemen::create([
            'nama' => 'Produksi'
        ]);
        Departemen::create([
            'nama' => 'Support'
        ]);

    }
}