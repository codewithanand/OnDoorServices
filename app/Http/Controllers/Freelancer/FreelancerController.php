<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FreelancerReview;
use App\Models\FreelancerService;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Freelancer;
use App\Models\BookedAppointment;

class FreelancerController extends Controller
{
    public function index(){
        $user = User::find(auth()->user()->id);
        $freelancer = Freelancer::where('user_id', auth()->user()->id)->first();
        if($freelancer){
            $cities = City::all();
            $booked_appointments = BookedAppointment::where('freelancer_id', $freelancer->id)->where('status', 0)->orderBy('id', 'DESC')->simplePaginate(5);
            $completed_appointments = BookedAppointment::where('freelancer_id', $freelancer->id)->where('status', 1)->orderBy('id', 'DESC')->simplePaginate(5);

            return view ("freelancer.dashboard", compact("cities", "freelancer", "user", 'booked_appointments', 'completed_appointments'));
        }
        else{
            return redirect("/freelancer/register");
        }
    }

    public function register(){
        $categories = Category::all();
        $freelancer = Freelancer::where('user_id', auth()->user()->id)->get();
        if(count($freelancer) > 0){
            return redirect("/freelancer/dashboard");
        }
        $states = State::all();
        return view("freelancer.register", compact("states", "categories"));
    }

    public function store(Request $request){

        $freelancer = new Freelancer;
        $freelancer->user_id = auth()->user()->id;
        $freelancer->name = $request->name;
        $freelancer->qualification = $request->qualification;
        $freelancer->gender = $request->gender;
        $freelancer->date_of_birth = $request->date_of_birth;
        $freelancer->working = $request->working;
        $freelancer->company = $request->company;
        $freelancer->position = $request->position;
        $freelancer->expirience = $request->expirience;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/freelancer/',$filename);
            $freelancer->image = $filename;
        }
        if($request->hasfile('id_proof')){
            $file = $request->file('id_proof');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/documents/',$filename);
            $freelancer->id_proof = $filename;
        }

        $freelancer->mobile = $request->mobile;
        $freelancer->altphone = $request->altphone;
        $freelancer->state_code = $request->state_code;
        $freelancer->district_code = $request->district_code;
        $freelancer->city_code = $request->city_code;
        $freelancer->village_code = $request->village_code;
        $freelancer->address = $request->address;
        $freelancer->save();

        // Reviews
        $review = new FreelancerReview;
        $review->freelancer_id = $freelancer->id;
        $review->stars = 4;
        $review->comment = "Good";
        $review->customer_name = "Anonymous";
        $review->save();

        // Services
        $services = $request->service_id;
        foreach($services as $service){
            $freelancer_service = new FreelancerService;
            $freelancer_service->service_id = $service;
            $freelancer_service->freelancer_id = $freelancer->id;
            $freelancer_service->save();
        }

        return redirect ('/freelancer/dashboard');
    }
}
