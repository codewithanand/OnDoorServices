<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BookedAppointment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;


use App\Models\Service;
use App\Models\Category;
use App\Models\FreelancerService;
use App\Models\Freelancer;
use App\Models\State;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate();
        return view("home.service.index", compact("services"));
    }

    public function services($category_slug, $service_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        $service = Service::where('slug', $service_slug)->first();
        $freelancer_services = FreelancerService::where('service_id', $service->id)->with('freelancers')->first();
        return view("home.service.service", compact("category", "service", "freelancer_services"));
    }

    public function book($category_slug, $service_slug, $freelancer_id)
    {
        $freelancer_id = Crypt::decryptString($freelancer_id);
        $freelancer = Freelancer::find($freelancer_id);
        $states = State::all();
        $categories = Category::all();
        return view("freelancer.book", compact("freelancer", "states", "categories", "category_slug", "service_slug"));
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
            $booked_appointment->freelancer_id = $request->freelancer_id;
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
