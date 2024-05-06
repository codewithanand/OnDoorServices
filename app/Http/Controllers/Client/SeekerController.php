<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Seeker;


class SeekerController extends Controller
{

    public function index(){
        $user = User::find(auth()->user()->id);
        $seeker = Seeker::where('user_id', auth()->user()->id)->first();
        $cities = City::all();
        return view ("user.seeker.dashboard", compact("cities", "seeker", "user"));
    }

    public function register(){
        $seeker = Seeker::where('user_id', auth()->user()->id)->get();
        if(count($seeker) > 0){
            return redirect("/seeker/dashboard");
        }
        $states = State::all();
        return view("user.seeker.register", compact("states"));
    }

    public function store(Request $request){

        $seeker = new Seeker;
        $seeker->user_id = auth()->user()->id;
        $seeker->name = $request->name;
        $seeker->qualification = $request->qualification;
        $seeker->gender = $request->gender;
        $seeker->date_of_birth = $request->date_of_birth;
        $seeker->working = $request->working;
        $seeker->company = $request->company;
        $seeker->position = $request->position;
        $seeker->expirience = $request->expirience;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/seeker/',$filename);
            $seeker->image = $filename;
        }
        if($request->hasfile('id_proof')){
            $file = $request->file('id_proof');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/documents/',$filename);
            $seeker->id_proof = $filename;
        }

        $seeker->mobile = $request->mobile;
        $seeker->altphone = $request->altphone;
        $seeker->state_code = $request->state_code;
        $seeker->district_code = $request->district_code;
        $seeker->city_code = $request->city_code;
        $seeker->village_code = $request->village_code;
        $seeker->address = $request->address;
        $seeker->save();

        return redirect ('/seeker/dashboard');
    }
}
