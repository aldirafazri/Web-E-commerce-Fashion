<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Models\Products;

use App\Models\Variants;

use App\Models\History_variants;

use Carbon\Carbon;

class VariantsController extends Controller
{
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
            $variants->id_produk=$id_produk;
            $variants->ukuran=$request->ukuran;
            $variants->stok=$request->stok;
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
            $variants->stok=$request->stok;

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


}