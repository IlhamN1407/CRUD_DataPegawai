<?php

namespace Database\Seeders;

use App\Models\jabatan_pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jabatanseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        jabatan_pegawai::factory()->count(3)->create();
    }
}
