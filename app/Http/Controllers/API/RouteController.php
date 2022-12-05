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
     // category update
     public function categoryUpdate(Request $request ){

        $categoryId = $request->category_id;

        $dbData = Category::where('id',$categoryId)->first();

        if(isset($dbData)){
             $data = $this->getCategoryData($request);
             $response = Category::where('id',$categoryId)->update($data);
             return response()->json( ['status' => true ,'message'=> 'category update success' ,'category' => $response ], 200);
        }
        return response()->json(['status' => false ,'message'=> 'no category avaliable' ,'category' => $response ], 500);
    }

    // get category data
    private function getCategoryData($request){
        return [
            'name'=> $request->category_name,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
            'updated_at' =>Carbon::now(),
        ];
    }

}

