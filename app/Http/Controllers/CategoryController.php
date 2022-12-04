<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // admin category list page
    function list() {
        $categories = Category::when(request ('search'), function ($query) {
            $query->where('name','like','%'. request('search') .'%');
        })
            ->orderBy('id', 'desc')
            ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }

    // direct category crate page
    public function createPage()
    {
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess' => 'Category အသစ် ဖြည့်သွင်း ပြီးပါပြီ။...']);
    }

    // delete category data
    public function delete($id)
    {

        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'ရွေးချယ်ထားသော Category အား ပယ်ဖျက် ပြီးပါပြီ။...']);
    }

    // edit page
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit', compact('category'));
    }

    // update page
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    // category validation check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|min:4|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    // request category data
    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName,
        ];
    }

}
