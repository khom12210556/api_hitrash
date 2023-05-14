<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pemesanan;

class penggunaModel extends Model
{
    protected $table = 'tb_pengguna' ;
    const CREATED_AT = 'dt_created' ;
    const UPDATED_AT = 'dt_updated'; 
    use HasFactory;

    public function pickupRequests()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
