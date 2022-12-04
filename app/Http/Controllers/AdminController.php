<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    // change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
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

            return back()->with(['changePasswordSuccess'=>'Password Changed!']);
        }
            return back()->with(['notMatch' => 'The Old Password incorrect. Try Again!']);
        }

        // direct admin details page
        public function details(){
            return view('admin.account.details');
        }

        // direct admin profile page
        public function edit(){
            return view('admin.account.edit');
        }

        // update account profile page
        public function update($id,Request $request){
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
            return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Profile Updated']);
        }

        // admin accounts list
        public function list(){
            $admin = User::when(request('search'),function($query){
                $query->orWhere('name','like',"%".request('search').'%')
                        ->orWhere('email','like',"%".request('search').'%')
                        ->orWhere('gender','like',"%".request('search').'%')
                        ->orWhere('phone','like',"%".request('search').'%')
                        ->orWhere('address','like',"%".request('search').'%');
            })
            ->where('role','admin')->paginate(3);
            $admin->appends(request()->all());
            return view('admin.account.list',compact('admin'));
        }

        // admin account delete
        public function delete($id){
           User::where('id',$id)->delete();
           return back()->with(['deleteSuccess' => 'Admin Account deleted']);
        }

        // change role page
        public function changeRole($id){
            $account = User::where('id',$id)->first();
                return view ('admin.account.changeRole',compact('account'));
        }


        // change role
        public function change($id,Request $request){
            $data = $this->requestUserData($request);
            User::where('id',$id)->update($data);
            return redirect()->route('admin#list')->with(['changeSuccess' => 'အကောင့်အား Admin List မှ ဖယ်ရှားပြီးပါပြီ။']);
        }

        // direct contact list page

        public function contactList(){
            $contactmessageList = Contact::select('contacts.*','users.name as user_name',)
                                    ->leftJoin('users','users.id','contacts.user_id')
                                    ->get();
            return view('admin.contact.contact',compact('contactmessageList'));
        }

        // request role data
        private function requestUserData($request){
            return [
                'role' => $request->role
            ];
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
                'image' => 'mimes:png,jpg,jpeg|file',
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
