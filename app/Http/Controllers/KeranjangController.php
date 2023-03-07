<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Variants;
use App\Models\Keranjang;
use App\Models\Detail_keranjang;
use Carbon\Carbon;
use App\Models\Orders;
class KeranjangController extends Controller
{

    #Melihat keranjang
    public function show_cart(){
        $user=Auth::user();
        $keranjang = Keranjang::where('id_pembeli',$user->id)->where('status','n')->first();
        $detailKeranjang = Detail_keranjang :: where('id_keranjang',$keranjang->id_keranjang)->get();
        
        return view('home.show_cart',compact('detailKeranjang','user'));
    }

    #Order
    public function make_order(Request $request, $id_keranjang){
        $user=Auth::user();

        $keranjang=Keranjang::find($id_keranjang);
        $keranjang->status='y';
        $keranjang->save();
        
        $newKeranjang = new Keranjang;
        $newKeranjang->status="n";
        $newKeranjang->id_pembeli=$user->id;
        $newKeranjang->save();

        $mytime = Carbon::now();
        $orders = new orders;
        $orders->id_keranjang= $id_keranjang;
        $orders->tanggal=$mytime->toDateTimeString();
        $orders->resi_Pengiriman='-';
        $orders->subtotal=$request->subtotal;
        $orders->total_harga=$request->totalharga;
        $orders->gambar='-';
        $orders->status='upload payment proof';
        $orders->save();
        $detailKeranjang = Detail_keranjang::where('id_keranjang',$id_keranjang)->get();
        foreach($detailKeranjang as $detailKeranjang){
            $variants=variants::where('id_variant',$detailKeranjang->id_varian)->first();
            $variants->stok = $variants->stok - $detailKeranjang->jumlah;
            $variants->save();
        }

        return redirect()->back();
    }

}
