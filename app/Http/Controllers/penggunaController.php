<?php

namespace App\Http\Controllers;

use App\Models\penggunaModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class penggunaController extends Controller
{
    public function login(){
        $email = request('email');
        $password = request('password');
        $remember = request('remember');
    
        $pengguna = penggunaModel::where('email', $email)->first();
        
        if (!$pengguna) {
            return response()->json([
                'pesan' => 'Email pengguna tidak terdaftar'
            ], 404);
        }
    
        if (Hash::check($password, $pengguna->password)) {
            $pengguna->token = Str::random(16);

            if ($remember) {
                $pengguna->remember_token = Str::random(60);
                session()->put('remember_token', $pengguna->remember_token);
            }

            $pengguna->save();
    
            return response()->json([
                'data' => $pengguna
            ]);
        }
    
        return response()->json([
            'pesan' => 'Email dan kata sandi tidak cocok'
        ]);
    }
    
    public function logout(){
        $id = request()->user()->id;
        $pengguna = penggunaModel::query()->where('id' , $id)->first();

        if ($pengguna != null){
            $pengguna->token = null;
        
            if ($pengguna->remember_token != null) {
                $pengguna->remember_token = null;
                session()->forget('remember_token');
            }

            $pengguna->save();
            return response()->json(['data'=>1]);
        } else {
            return response()->json([
                'pesan' => 'Logout tidak berhasil, pengguna tidak tersedia'
            ], 404);
        }
    }

    public function update(){
        $id = request()->user()->id;
        $pengguna = penggunaModel::query()->where('id', $id)->first();

        if($pengguna == null){
            return response()->json([
                'pesan' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        $pengguna->nama_lengkap = request('nama_lengkap');
        $pengguna->email = request('email');
        $r = $pengguna->save();

        return response()->json([
            'data' => $pengguna
        ], $r == true ? 200 : 406);
    }

    public function simpan_photo(){
        $id = request()->user()->id;
        $pengguna = penggunaModel::query()->where('id', $id)->first();

        if($pengguna == null){
            return response()->json(['pesan'=>'Pengguna tidak terdaftar'], 404);
        }

        $b64foto = request('file_foto');

        if(strlen($b64foto) < 1023){
            return response()->json(['pesan'=>'File foto kurang ukurannya'], 406);
        }

        $foto = base64_decode($b64foto);
        $r = Storage::put("foto/$id.jpg", $foto);

        return response()->json([
            'data' => $r

        ], $r == true ? 200 : 406);
    }

    public function photo(){
        $id = request()->user()->id;
        $foto = Storage::get("foto/$id.jpg");

        return response($foto)->header('Content-Type', 'image/jpeg');
    }
}