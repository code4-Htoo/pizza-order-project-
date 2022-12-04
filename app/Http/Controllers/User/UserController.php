<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home(){
        $pizza = Product::orderBy('created_at','asc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    // change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request){
        /*
            1. all field must be filled
            2. new password & confirm password lenght must be greater than 6
            3. new password & confirm password must same
            4. client old password must be same with db password
            5. password change
        */

        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            // LOGOUT after PasswrodChange

            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return redirect()->route('user#accountEditPage')->with(['changePasswordSuccess'=>'Password Changed!']);

        }
            return back()->with(['notMatch' => 'The Old Password incorrect. Try Again!']);
        }

        // user account change page
        public function accountEditPage(){
            return view('user.proifle.account');
        }

        // pizza filter
        public function filter($categoryId){
            $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
            $category = Category::get();
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $history = Order::where('user_id',Auth::user()->id)->get();
            return view('user.main.home',compact('pizza','category','cart','history'));
        }

        // direct pizza details
        public function pizzaDetails($pizzaId){
            $pizza = Product::where('id',$pizzaId)->first();
            $pizzaList = Product::get();
            return view('user.main.details',compact('pizza','pizzaList'));
        }

        // user cart page
        public function cartList(){
            $cartList = Cart::select('carts.*','products.name as pizza_name', 'products.price as pizza_price' ,'products.image as pizza_image')
                        ->leftjoin('products','products.id','carts.product_id')
                        ->where('carts.user_id',Auth::user()->id)
                        ->get();
            // dd($cartList->toArray());

            $totalPrice = 0;
            foreach($cartList as $c){
                $totalPrice += $c->pizza_price*$c->qty;
            }

            return view('user.cart.cart',compact('cartList','totalPrice'));
        }


        // user account change details
        public function accountEdit($id,Request $request){
                $this->accountValidationCheck($request);
                $data = $this->getUserData($request);

                    // for image
                    if($request->hasFile('image')){
                        //1. old image nmae |2. check => delete |3. store
                        $dbImage = User::where('id',$id)->first();
                        $dbImage = $dbImage->image;

                        if($dbImage != null){
                            Storage::delete(['public/'.$dbImage]);
                        }

                        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                        $request->file('image')->storeAs('public',$fileName);
                        $data['image'] = $fileName;


                    }
                User::where('id',$id)->update($data);
                return redirect()->route('user#accountEditPage')->with(['updateSuccess' => 'User Profile Updated']);
                }

            // direct history page
            public function history(){
                    $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
                    return view ('user.main.history',compact('order'));
                }

            // request user data
            private function  getUserData($request){
                return [
                    'name' => $request->name,
                    'email' => $request->email,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'updated_at' => Carbon::now(),
                ];
            }


            // account validation check
            private function accountValidationCheck($request){
                Validator::make($request->all(),[
                    'name' => 'required' ,
                    'email' => 'required' ,
                    'gender' => 'required' ,
                    'phone' => 'required' ,
                    'image' => 'mimes:png,jpg,jpeg,webP,jfif|file',
                    'address' => 'required' ,
                ])->validate();
            }

            // password validation check
            private function passwordValidationCheck($request){
                Validator::make($request->all(),[
                    'oldPassword' => 'required|min:6',
                    'newPassword' => 'required|min:6',
                    'confirmPassword' =>'required|min:6|same:newPassword',
                ])->validate();
            }

}

