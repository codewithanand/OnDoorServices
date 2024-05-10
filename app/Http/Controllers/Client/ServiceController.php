<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Service;
use App\Models\Category;
use App\Models\FreelancerService;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::simplePaginate(12);
        return view ("home.service.index", compact("services"));
    }

    public function services($category_slug, $service_slug){
        $category = Category::where('slug', $category_slug)->first();
        $service = Service::where('slug', $service_slug)->first();
        $freelancer_services = FreelancerService::where('service_id', $service->id)->with('freelancers')->first();
        return view ("home.category.service", compact("category", "service", "freelancer_services"));
    }
}
