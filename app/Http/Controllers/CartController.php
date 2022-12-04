<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // user cart page
    public function cart(){
        return view('user.cart.cart');
    }
}
