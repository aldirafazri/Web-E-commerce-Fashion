<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

use App\Models\Variants;

class ProductsController extends Controller
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

            $products->nama=$request->nama;
            $products->berat=$request->berat;
            $products->harga=$request->harga;
            $products->deskripsi=$request->deskripsi;

            $image = $request->gambar;

            $gambar=time().'.'.$image->getClientOriginalExtension();

            $request->gambar->move('products',$gambar);

            $products->gambar=$gambar;

            $products->save();

            return redirect()->back()->with('message','Product added');
        }
        else{
            return redirect()->back()->with('message','Price or weight is not valid');
        }
        
    }
    #Melihat detail produk
    public function view_product($id_produk){
        $products=products::find($id_produk);
        $variants= variants::where('variants.id_produk','=',$id_produk)->where('stok','>',0)->get();
        return view('home.view_product',compact('products','variants'));
    }

    #Menghapus produk
    public function delete_product($id_produk){
        $products=products::find($id_produk);
        $products->delete();
        return redirect()->back()->with('message','Product Deleted');
    }

    #Melihat seluruh produk yang dijual
    public function products(){
        $products = products::all();
        return view('admin.products',compact('products'));
    }
}
