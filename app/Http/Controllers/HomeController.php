<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Products;
use App\Models\Variants;
use App\Models\Keranjang;
use App\Models\Detail_keranjang;
use App\Models\Orders;
use Carbon\Carbon;
class HomeController extends Controller
{
    #Tampilan home
    public function index(){
        $products = products::paginate(9);
        return view('home.userpage',compact('products'));
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

    #Cek user yang login admin atau pembeli
    public function redirect(){
        $usertype=Auth::user()->usertype;
        $user=Auth::user();

        if($usertype=='1'){
            return view('admin.home',compact('user'));
        }
        else{

            $existed = Keranjang::where('id_pembeli',$user->id)->where('status','n')->exists();
            if($existed==0){
                $keranjang = new keranjang;
                $keranjang->id_pembeli=$user->id;
                $keranjang->status="n";
                $keranjang->save();
            }

            $products = products::paginate(6);
            return view('home.userpage',compact('products'));
            
        }
    }

    #Melihat keranjang
    public function show_cart(){
        $user=Auth::user();
        $keranjang = Keranjang::where('id_pembeli',$user->id)->where('status','n')->first();
        $detailKeranjang = Detail_keranjang :: where('id_keranjang',$keranjang->id_keranjang)->get();
        
        return view('home.show_cart',compact('detailKeranjang','user'));
    }

    #Melihat detail produk
    public function view_product($id_produk){
        $products=products::find($id_produk);
        $variants= variants::where('variants.id_produk','=',$id_produk)->where('stok','>',0)->get();
        return view('home.view_product',compact('products','variants'));
    }

    #Melihat semua produk yang dijual
    public function view_all_product(){
        $products = products::paginate(12);
        return view('home.view_all_product',compact('products'));
    }

    #Mencari produk
    public function search_product(Request $request){
        $products = products::where('nama','LIKE','%'. $request->search .'%')->paginate(12);
        return view('home.searchProduct',compact('products'));
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

    #Menghapus produk pada keranjang
    public function delete_product_in_cart($id_detailKeranjang){
        $detailKeranjang = Detail_keranjang::find($id_detailKeranjang);
        $detailKeranjang->delete();
        return redirect()->back();
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

    #Mengganti alamat
    #Menampilkan form mengganti alamat
    public function edit_address(){
        $user=Auth::user();
        return view('home.editAddress',compact('user'));
    }

    #Input data dari form mengganti alamat
    public function edit_address_confirm(Request $request){
        $user=Auth::user();
        $user->address=$request->address;
        $user->save();
        return redirect()->back()->with('message','Success changing address!!');
    }
}
