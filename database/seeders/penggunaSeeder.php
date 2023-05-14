<?php

namespace Database\Seeders;

use App\Models\penggunaModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class penggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        penggunaModel::query()->create([
            'nama_lengkap' => 'Khomarul Arifin',
            'email' => 'khomarularifin@gmail.com',
            'password' => Hash::make('admin'),
            'no_hp' => '087845010525',
            'alamat' => 'jalan gusti samsudin',
            'kota'  => 'jakarta',
            'jenis_pengguna' => 'penjemput',
            
        ]);
    }
}
