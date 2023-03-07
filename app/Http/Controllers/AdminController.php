<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Products;

use App\Models\Variants;

use App\Models\Orders;

use App\Models\Detail_keranjang;

use App\Models\History_variants;

use Carbon\Carbon;

class AdminController extends Controller
{
    #Products
    #Menambah produk
    #Menampilkan form tambah produk
    public function add_products(){
        return view('admin.add_products');
    }

    #Input data dari form tambah produk
    public function add_products_confirm(Request $request){

        if(is_numeric($request->berat) and is_numeric($request->harga) and $request->berat>0 and $request->harga>0){
            $products= new products;

            $products->add_products($request->nama, $request->berat, $request->harga, $request->deskripsi, $request->gambar);

            $products->save();

            return redirect()->back()->with('message','Product added');
        }
        else{
            return redirect()->back()->with('message','Price or weight is not valid');
        }
        
    }

    #Melihat seluruh produk yang dijual
    public function products(){
        $products = products::all();
        return view('admin.products',compact('products'));
    }

    #Menghapus produk
    public function delete_product($id_produk){
        $products=products::find($id_produk);
        $products->delete();
        return redirect()->back()->with('message','Product Deleted');
    }

    #Variants
    #Melihat seluruh variant dari produk
    public function variants($id_produk){
        $variants= variants::where('variants.id_produk','=',$id_produk)->get();
        return view('admin.variants',compact('variants'));
    }

    #Menambah variant baru
    #Menampilkan form tambah variant
    public function add_variants($id_produk){
        $products=products::find($id_produk);
        return view('admin.add_variants',compact('products'));
    }
    
    #Input data dari form tambah variant
    public function add_variants_confirm(Request $request,$id_produk){
        
        $existed= variants::where('id_produk',$id_produk)->where('ukuran',$request->ukuran)->exists();
        if($existed == 1){
            return redirect()->back()->with('message','Variant already existed!!');
        }
        else if(is_numeric($request->stok)){
            $variants=new variants;
            $variants->add_variants($request->ukuran,$request->stok,$id_produk);
            $variants->save();
    
            return redirect()->back()->with('message','Variants added');
        }
        else{
            return redirect()->back()->with('message','Stock not valid');
        }
        
    }

    #Mengatur stok variant
    #Menampilkan form mengatur stok variant
    public function edit_variants($id_variant){
        $variants=variants::find($id_variant);
        return view('admin.edit_variants',compact('variants'));
    }

    #Input data dari form mengatur stok variant
    public function edit_variants_confirm(Request $request,$id_variant){
        if(is_numeric($request->stok) and $request->stok>0){
            $mytime = Carbon::now();
            $user=Auth::user();
            $History_variants= new History_variants;
            $History_variants->id_admin=$user->id;
            $History_variants->id_variant=$id_variant;
            $History_variants->waktu=$mytime->toDateTimeString();

            $variants=variants::find($id_variant);
            $History_variants->stok_lama=$variants->stok;
            $History_variants->stok_baru=$request->stok;
            $variants->edit_variants($request->stok);

            $variants->save();
            $History_variants->save();
            return redirect()->back()->with('message','Variants edited');
        }
        else{
            return redirect()->back()->with('message','Stock not valid');
        }
    }

    #Menghapus variant
    public function delete_variants(Request $request,$id_variant){
        $variants=variants::find($id_variant);
        $variants->delete();
        return redirect()->back()->with('message','Variant Deleted');
    }

    #Orders
    #Melihat seluruh order yang masuk
    public function orders(){
        $orders = orders::all();
        return view('admin.orders',compact('orders'));
    }

    #Melihat detail order
    public function ordersDetail($id_orders){
        $orders = orders::where('id_orders',$id_orders)->first();
        $detailKeranjang=Detail_keranjang::where('id_keranjang',$orders->id_keranjang)->get();
        return view('admin.ordersDetail',compact('orders','detailKeranjang'));
    }





    #Melihat history variants
    public function history_variants($id_variant){
        $History_variants = History_variants::where('id_variant',$id_variant)->get();
        return view('admin.history_variants',compact('History_variants'));
    }

}
