<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function GetProduct($id){
        $product = DB::table('products')
            ->where('category_id',$id)
            ->get();
            return response()->json($product);
    }
}
