<?php

namespace App\Http\Controllers;

use App\Models\pemesananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class pemesananController extends Controller

{
    public function store(){
        $fields = [
            'tanggal_penjemputan', 'jam_penjemputan', 'alamat', 'lokasi', 'kota', 'nama_pemesan', 'status'
        ];
    
        $data = [];
        foreach($fields as $f){
            $data[$f] = request($f);
        }
    
        $data['pengguna_id'] = request()->user()->id;
        $data['status'] = 'baru'; // tambahkan status baru
        $data['dt_created'] = now(); // tambahkan datetime created
        $data['dt_updated'] = now(); // tambahkan datetime updated
    
        $r = pemesananModel::query()->create($data);
        return response()->json([
            'data' => $r
        ]);
    }

    public function update(pemesananModel $w){
        $w->tanggal_penjemputan = request('tanggal_penjemputan');
        $w->jam_penjemputan = request('jam_penjemputan');
        $w->alamat = request('alamat');
        $w->lokasi = request('lokasi');
        $w->kota = request('kota');
        $w->nama_pemesan = request('nama_pemesan');
        $w->status = request('status');
        $r = $w->save();

        return response()->json([
            'data' => $w
        ], $r == true? 200 : 406);
    }

    public function delete(pemesananModel $w){
        return response()->json([
            'data' => $w->delete()
        ]);
    }

    public function simpan_photo(){
        $id = request()->id;
        $p = pemesananModel::query()->where('id', $id)->first();

        if($p == null){
            return response()->json(['pesan'=>'Pesanan tidak terdaftar'], 404);
        }

        $b64foto = request('file_foto');

        if(strlen($b64foto) < 1923){
            return response()->json(['pesan'=>'file foto kurang ukurannya'], 406);
        }

        $foto = base64_decode($b64foto);
        $r = Storage::put("foto/$id.jpg", $foto);

        return response()->json([
            'data' => $r
        ], $r == true ? 200 : 406);
    }

    public function show(pemesananModel $w){
        return response()->json([
            'data' => $w
        ]);
    }
}
