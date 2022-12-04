<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function list(){
        $pizzas = Product::select("products.*","categories.name as category_name")
        ->when(request('search'),function($query){
            $query->where('products.name','like','%'.request('search').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);

        // dd($pizzas->toArray());
        $pizzas->appends(request()->all());
        return view ('admin.product.pizzaList',compact('pizzas'));
    }

    // direct pizza create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Delete Success']);
    }

    // edit pizza
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();

        return view('admin.product.edit',compact('pizza'));
    }

    // update pizza page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    // create products
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);

            $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list')->with(['createSuccess'=>'Product Create Success']);;
    }

    // update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
       $data = $this->requestProductInfo($request);

       // for image
        if ($request->hasFile('pizzaImage')){
            $dbimage = Product::where('id',$request->pizzaId)->first();
            $dbimage = $dbimage->image;

            if($dbimage != null){
                Storage::delete(['public/'. $dbimage]);
            }

            $fileName = uniqid() .$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public/',$fileName);
            $data['image'] = $fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }



    //request product info
    private function requestProductInfo($request){
        return[
            'category_id' => $request->pizzaCategory,
            'name' =>$request->pizzaName,
            'description' =>$request->pizzaDescription,
            'waiting_time' =>$request->pizzaWaitingTime,
            'price'=>$request->pizzaPrice,
        ];
    }

    // product validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaWaitingTime' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png|file' : "mimes:jpg,jpeg,png|file";
        Validator::make($request->all(),$validationRules)->validate();
    }
}
