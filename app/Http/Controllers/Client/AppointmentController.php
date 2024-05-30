<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BookedAppointment;
use Illuminate\Http\Request;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\State;

class AppointmentController extends Controller
{
    public function index(){
        $categories = Category::all();
        $states = State::all();
        return view ("home.call.index", compact('states', 'categories'));
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
            $appointment->booked = 1;
            $appointment->save();

            $booked_appointment = new BookedAppointment;
            $booked_appointment->freelancer_id = '0';
            $booked_appointment->appointment_id = $appointment->id;
            $booked_appointment->booking_date = date("Y-m-d");
            $booked_appointment->save();

            return redirect()->back()->with("success", "Your request is submitted. Hang on, our agent will call you soon!");
        }
        catch(error){
            return redirect()->back()->with("error", "Something went wrong! Please come back later.");

        }
    }
}
