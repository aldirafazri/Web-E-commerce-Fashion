<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $id_orders;
    protected $id_keranjang;
    protected $tanggal;
    protected $resi_pengiriman;
    protected $subtotal;
    protected $total_harga;
    protected $gambar;
    protected $status;
    public function keranjang(){
        return $this->belongsTo(Keranjang::class,'id_keranjang','id_keranjang');
    }
}
