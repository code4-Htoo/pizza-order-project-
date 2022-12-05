<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // get all product list
    public function productList()
    {
        $products = Product::get();
        $users = User::get();

        $data = [
            'product' => $products,
            'user' => $users,
        ];
        return
        response()->json($data, 200);
    }

    // get all category list
    public function categoryList()
    {
        $category = Category::get();

        return response()->json($category, 200);
    }

    // create category
    public function categoryCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }
    // category update
    public function categoryUpdate(Request $request)
    {

        $categoryId = $request->category_id;

        $dbData = Category::where('id', $categoryId)->first();

        if (isset($dbData)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);

            $response = Category::where('id', $categoryId)->first();
            return response()->json(['status' => true, 'message' => 'category update success', 'category' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'no category avaliable'], 500);
    }

    // get category data
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
        ];
    }

}
