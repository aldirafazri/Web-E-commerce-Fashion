<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Products;
use App\Models\Keranjang;

class UserController extends Controller
{
    #Tampilan home
    public function index(){
        $products = products::paginate(9);
        return view('home.userpage',compact('products'));
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
