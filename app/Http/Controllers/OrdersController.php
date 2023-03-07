<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Variants;

use App\Models\Orders;

use App\Models\Detail_keranjang;

use App\Models\Keranjang;

use Carbon\Carbon;
class OrdersController extends Controller
{
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


    #Melihat detail order
    public function orderscustdetail($id_orders){
        $orders=orders::where('id_orders',$id_orders)->first();
        $detailKeranjang=Detail_keranjang::where('id_keranjang',$orders->id_keranjang)->get();
        return view('home.orderscustdetail',compact('orders','detailKeranjang'));
    }

    #Melihat seluruh order
    public function show_orders(){
        $user=Auth::user();
        $keranjang=Keranjang::where('id_pembeli',$user->id)->where('status','y')->get();
        return view('home.orders',compact('keranjang'));
    }

    #Menambah bukti pembayaran
    #Menampilkan form bukti pembayaran
    public function add_paymentProof($id_orders){
        $orders=orders::where('id_orders',$id_orders)->first();
        return view('home.paymentProof',compact('orders'));
    }

    #Input data dari form pembayaran
    public function add_paymentProof_confirm(Request $request,$id_orders){
        $image = $request->inputimage;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->inputimage->move('orders',$imagename);
        $orders=orders::where('id_orders',$id_orders)->update(array('gambar'=>$imagename));
        $orders=orders::where('id_orders',$id_orders)->update(array('status'=>"Checking payment"));
    }

    #Menambah nomor pengiriman
    #Menampilkan form menambah nomor pengiriman
    public function add_shippment($id_orders){
        $orders = orders::where('id_orders',$id_orders)->first();
        return view('admin.add_shippment',compact('orders'));
    }

    #Input data dari form menambah nomor pengiriman
    public function add_shippment_confirm(Request $request,$id_orders){
        if(is_numeric($request->resi_Pengiriman) and $request->resi_Pengiriman>0){
            $orders = orders::where('id_orders',$id_orders)->update(array('resi_Pengiriman'=>$request->resi_Pengiriman));
            return redirect()->back()->with('message','Success');
        }
        else{
            return redirect()->back()->with('message','Shippment number is not valid');
        }
    }

    #validasi bukti pembayaran
    #Menampilkan form validasi bukti pembayaran
    public function paymentProof($id_orders){
        $orders = orders::where('id_orders',$id_orders)->first();
        return view('admin.paymentProof',compact('orders'));
    }

    #Input data dari form validasi bukti pembayaran
    public function paymentProof_confirm(Request $request,$id_orders){
        $orders=orders::where('id_orders',$id_orders)->update(array('status'=>$request->status));
        return redirect()->back()->with('message','Validation Success');
    }

    public function orders(){
        $orders = orders::all();
        return view('admin.orders',compact('orders'));
    }

    public function ordersDetail($id_orders){
        $orders = orders::where('id_orders',$id_orders)->first();
        $detailKeranjang=Detail_keranjang::where('id_keranjang',$orders->id_keranjang)->get();
        return view('admin.ordersDetail',compact('orders','detailKeranjang'));
    }

}
