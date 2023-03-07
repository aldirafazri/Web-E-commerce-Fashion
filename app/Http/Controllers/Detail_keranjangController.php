<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Variants;
use App\Models\Keranjang;
use App\Models\Detail_keranjang;
class Detail_keranjangController extends Controller
{
    
    #Menghapus produk pada keranjang
    public function delete_product_in_cart($id_detailKeranjang){
        $detailKeranjang = Detail_keranjang::find($id_detailKeranjang);
        $detailKeranjang->delete();
        return redirect()->back();
    }

    #Menambah produk pada keranjang
    public function add_cart(Request $request){
        if(Auth::id()){
            $user=Auth::user();
            $variants = variants::where('id_variant',$request->ukuran)->first();
            $keranjang = Keranjang::where('id_pembeli',$user->id)->where('status','n')->first();
            if(empty($variants)){
                return redirect()->back()->with('message','Please select size!!');
            }
            $existed = Detail_keranjang::where('id_varian',$variants->id_variant)->where('id_keranjang',$keranjang->id_keranjang)->exists();
            if($existed == 1){
                $detailKeranjang = Detail_keranjang::where('id_varian',$variants->id_variant)->where('id_keranjang',$keranjang->id_keranjang)->first();
                $cekStok = variants::where('id_variant',$variants->id_variant)->first();
                if($cekStok->stok<$detailKeranjang->jumlah+1){
                    return redirect()->back()->with('message','Stock not available!!');
                }
                else{
                    $detailKeranjang->jumlah = $detailKeranjang->jumlah +1;
                    $detailKeranjang->save();
                }
            }
            else{
                $detailKeranjang = new Detail_keranjang;
                $detailKeranjang->id_keranjang = $keranjang->id_keranjang;
                $detailKeranjang->jumlah=1;
                $detailKeranjang->id_varian = $variants->id_variant;
                $detailKeranjang->save();
            }

            $detailKeranjang = Detail_keranjang :: where('id_keranjang',$keranjang->id_keranjang)->get();
        
            return redirect()->back()->with('message','Success adding product to cart!!');
        }

        else{

            return redirect('login');
        }
    }
}