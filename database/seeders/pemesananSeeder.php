<?php

namespace Database\Seeders;

use App\Models\pemesananModel;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class pemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pemesananModel::query()->create([
            'tanggal_penjemputan' => '2023-05-13',
            'jam_penjemputan' => '15:30:45',
            'alamat'    => 'gusti hamzah',
            'lokasi'    => '-0.02984970545275237, 109.33662812197348',
            'kota'      => 'pontianak',
            'nama_pemesan' => 'Messi',
            'status' => 'baru',
            'pengguna_id' => 1,
        ]);
    }
}
