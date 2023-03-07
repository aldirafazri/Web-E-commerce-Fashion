<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_keranjang extends Model
{
    use HasFactory;

    protected $id;
    protected $id_varian;
    protected $id_keranjang;
    protected $jumlah;

    public function keranjang(){
        return $this->belongsTo('Keranjang');
    }
    public function variant(){
        return $this->hasOne(Variants::class,'id_variant','id_varian');
    }
}
