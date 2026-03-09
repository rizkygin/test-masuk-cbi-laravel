<?php

namespace Database\Seeders;

// use App\Models\Departemen;
use App\Models\Izin;
use App\Models\karyawan;
use Database\Seeders\DepartemenSeeder;
use Database\Seeders\JabatanSeeder;
use App\Models\User;
use App\Models\Absen;
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
        // User::factory()->count(10)->create();
        $admin = User::create([
            'name' => 'Rizky Kurniawan',
            'email' => 'programmer@da',
            'password' => '12345678',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        karyawan::create([
            'nama' => 'Rizky Kurniawan',
            'jabatan_id' => 1,
            'departemen_id' => 1,
            'user_id' => $admin->id,
        ]);
        $karyawan2 = User::create([
            'name' => 'Rizky Kurniawan',
            'email' => 'programmer2@da',
            'password' => '12345678',
            'role' => 'employee_reguler',
            'email_verified_at' => now(),
        ]);
        karyawan::create([
            'nama' => 'Rizky Kurniawan',
            'jabatan_id' => 1,
            'departemen_id' => 1,
            'user_id' => $karyawan2->id,
        ]);

        karyawan::factory()->count(100)->create();

        Izin::factory()->count(200)->create();
        Absen::factory()->count(200)->create();

    }
}