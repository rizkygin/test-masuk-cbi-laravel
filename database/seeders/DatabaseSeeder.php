<?php

namespace Database\Seeders;

// use App\Models\Departemen;
use App\Models\karyawan;
use Database\Seeders\DepartemenSeeder;
use Database\Seeders\JabatanSeeder;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DepartemenSeeder::class ,
            JabatanSeeder::class ,

        ]);
        User::factory()->count(10)->create();
        karyawan::factory()->count(100)->create();

    }
}