<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServicePartner;

class ServicePartnerController extends Controller
{
    public function index(){
        return view ("partner.register");
    }

    public function store(Request $request){
        $newServicePartner = new ServicePartner;
        $newServicePartner->user_id =auth()->user()->id;
        $newServicePartner->full_name =$request ->full_name;
        $newServicePartner->father_name =$request ->father_name;
        $newServicePartner->company_name = $request->company_name;
        $newServicePartner->dob = $request->dob;
        $newServicePartner->gender = $request->partnerGender;
        $newServicePartner->email = $request->email;
        $newServicePartner->phone_number = $request->phone_number;
        $newServicePartner->country = $request->country;
        $newServicePartner->state = $request->state;
        $newServicePartner->city = $request->city;
        $newServicePartner->address = $request->address;
        $newServicePartner->experience_year = $request->experience_year;
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/servicepartner/',$filename);
            $newServicePartner->image = $filename;
        }
        
        $newServicePartner->save();
        return redirect('/partner/services/add');
    }
}

