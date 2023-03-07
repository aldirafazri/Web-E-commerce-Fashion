<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';
    protected $nama;
    protected $berat;
    protected $harga;
    protected $deskripsi;
    protected $gambar;

    public function variants(){
        return $this->hasMany(Variants::class,'id_produk');
    }
}
