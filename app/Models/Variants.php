<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_variant';
    protected $ukuran;
    protected $stok;
    protected $id_produk;
    public function products(){
        return $this->belongsTo(Products::class,'id_produk','id_produk');
    }

    public function detailKeranjang(){
        return $this->hasMany(Detail_keranjang::class,'id_varian','id_variant');
    }
}
