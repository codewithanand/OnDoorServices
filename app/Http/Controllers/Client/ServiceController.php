<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
}
