<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPannelController extends Controller
{
    // user pannel
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    // change user role
    public function userChangeRole(Request $request){
        $updateSource = [
            'role'=> $request->role
        ];

        User::where('id',$request->userId)->update($updateSource);
    }
}
