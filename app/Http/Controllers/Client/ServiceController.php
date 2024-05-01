<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServicePartner;
use App\Models\Category;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index($id){
        $service = Service::find($id);
        $category = Category::where("id", $service->category_id)->first();
        $service_partner = ServicePartner::where('id', $service->service_partner_id)->first();
        return view("user.service.index", compact("category", "service", "service_partner"));
    }

    public function services(){
        $service_type = "Services";
        $services = Service::where('service', 1)->simplePaginate(10);
        return view ("user.service.service", compact('services', 'service_type'));
    }

    public function jobs(){
        $service_type = "Jobs";
        $services = Service::where('service', 0)->simplePaginate(10);
        return view ("user.service.service", compact('services', 'service_type'));
    }
}
