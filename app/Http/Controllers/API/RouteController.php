<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all product list
    public function productList(){
        $products = Product::get();
        $users = User::get();

        $data = [
            'product' => $products ,
            'user' => $users
        ];
        return
        response()->json($data, 200);
    }

    // get all category list
    public function categoryList(){
        $category =  Category::get();

        return response()->json($category, 200);
    }

    // create category
public function categoryCreate (Request $request){
    $data = [
        'name' => $request->name,
        'created_at' => Carbon::now(),
        'updated_at' =>Carbon::now()
    ];
    $response =  Category::create($data);
    return response()->json($response, 200);
}
}
