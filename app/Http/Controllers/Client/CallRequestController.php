<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Exception;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\State;

class CallRequestController extends Controller
{
    public function index(){
        $categories = Category::all();
        $states = State::all();
        return view ("user.call.index", compact('states', 'categories'));
    }

    public function store(Request $request){
        try{
            $appointment = new Appointment;
            $appointment->name = $request->name;
            $appointment->category_id = $request->category_id;
            $appointment->service_id = $request->service_id;
            $appointment->problem = $request->problem;
            $appointment->mobile = $request->mobile;
            $appointment->state_code = $request->state_code;
            $appointment->district_code = $request->district_code;
            $appointment->city_code = $request->city_code;
            $appointment->village_code = $request->village_code;
            $appointment->address = $request->address;
            $appointment->save();
            return redirect()->back()->with("success", "Your service request is submitted. Hang on, we will call you back soon!");
        }
        catch(error){
            return redirect()->back()->with("error", "Something went wrong! Please come back later.");

        }
    }
}
