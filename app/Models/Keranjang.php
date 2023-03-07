<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_keranjang';
    protected $id_pembeli;
    protected $status;
    
    public function DetailKeranjang(){
        return $this->hasMany('Detail_keranjang');
    }
    public function orders(){
        return $this->hasOne(Orders::class,'id_keranjang','id_keranjang');
    }

    public function user(){
        return $this->belongsTo(User::class,'id_pembeli','id');
    }
}
