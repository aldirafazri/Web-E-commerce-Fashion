<?php

namespace App\Http\Controllers;

use App\Models\History_variants;


class History_variantsController extends Controller
{

    #Melihat history variants
    public function history_variants($id_variant){
        $History_variants = History_variants::where('id_variant',$id_variant)->get();
        return view('admin.history_variants',compact('History_variants'));
    }

}
