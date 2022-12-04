<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // direct contact page
    public function contactListPage(){
        return view('user.main.contactForm');
    }

    // list
    public function contactList(Request $input){
        $this->ValidationCheck($input);
        Contact::create([
            'name' => $input->name,
            'email' => $input->email,
            'user_id' =>$input->userId,
            'message' => $input->message,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('user#contactListPage')->with(['contactSuccess' => 'Contacted']);
    }

    // validation check
    private function ValidationCheck($input){
        Validator::make($input->all(),[
            'name' => 'required' ,
            'email' => 'required' ,
            'message' => 'required',
        ])->validate();
    }
}
