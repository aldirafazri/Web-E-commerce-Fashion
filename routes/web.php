<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Detail_keranjangController;

use App\Http\Controllers\History_variantsController;

use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrdersController;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/',[UserController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

#admin route

#Products
#Menambah produk
route::get('/add_products',[ProductsController::class,'add_products']);
route::post('/add_products_confirm',[ProductsController::class,'add_products_confirm']);

#Melihat produk
route::get('/show_products',[ProductsController::class,'products']);

#Menghapus produk
route::get('/delete_product/{id_produk}',[ProductsController::class,'delete_product']);

#Variant
#Menambah varian
route::get('/add_variants/{id_produk}',[VariantsController::class,'add_variants']);
route::post('/add_variants_confirm/{id_produk}',[VariantsController::class,'add_variants_confirm']);

#Mengatur stok varian
route::get('/edit_variants/{id_variant}',[VariantsController::class,'edit_variants']);
route::post('/edit_variants_confirm/{id_variant}',[VariantsController::class,'edit_variants_confirm']);

#Menghapus variant
route::get('/delete_variants/{id_variant}',[VariantsController::class,'delete_variants']);

#Melihat varian
route::get('/variants/{id_produk}',[VariantsController::class,'variants']);

#Melihat history variant
route::get('/history_variants/{id_variant}',[History_variantsController::class,'history_variants']);

#Orders
#Melihat order
route::get('/admin_orders',[OrdersController::class,'orders']);

#Melihat detail order
route::get('/ordersDetail/{id_orders}',[OrdersController::class,'ordersDetail']);

#Melakukan validasi bukti pembayaran
route::get('/admin_paymentProof/{id_orders}',[OrdersController::class,'paymentProof']);
route::post('/admin_paymentProof_confirm/{id_orders}',[OrdersController::class,'paymentProof_confirm']);

#Melakukan input resi pengiriman
route::get('/add_shippment/{id_orders}',[OrdersController::class,'add_shippment']);
route::post('/add_shippment_confirm/{id_orders}',[OrdersController::class,'add_shippment_confirm']);


#Pembeli/Guest user route

#Home 
route::get('/redirect',[UserController::class,'redirect']);

#Melihat keranjang
route::get('/show_cart',[KeranjangController::class,'show_cart']);

#Melihat detail produk
route::get('/view_product/{id_produk}',[ProductsController::class,'view_product']);

#Melihat produk
route::get('/view_all_product',[UserController::class,'view_all_product']);

#Melihat detail order
route::get('/orderscustdetail/{id_orders}',[OrdersController::class,'orderscustdetail']);

#Melihat order
route::get('/show_orders',[OrdersController::class,'show_orders']);

#Menambah produk ke keranjang
route::post('/add_cart',[Detail_keranjangController::class,'add_cart']);

#Upload bukti pembayaran
route::get('/add_paymentProof/{id_orders}',[OrdersController::class,'add_paymentProof']);
route::post('/add_paymentProof_confirm/{id_orders}',[OrdersController::class,'add_paymentProof_confirm']);

#Menghapus produk pada keranjang
route::get('/delete_product_in_cart/{id}',[Detail_keranjangController::class,'delete_product_in_cart']);

#Order
route::post('/make_order/{id_keranjang}',[KeranjangController::class,'make_order']);

#Mencari produk
route::get('/search_product',[UserController::class,'search_product']);

#Mengganti alamat
route::get('/edit_address',[UserController::class,'edit_address']);
route::post('/edit_address_confirm',[UserController::class,'edit_address_confirm']);