<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServicePartner;
use App\Models\Category;
use App\Models\ServiceRequest;


class PartnerController extends Controller
{
    public function index(){
        $categories = Category::all();

        $user_id = auth()->user()->id;
        $service_partner = ServicePartner::where('user_id', $user_id)->first();
        $services = Service::where('service_partner_id', $service_partner->id)->simplePaginate(5);

        $service_requests = collect();
        $job_requests = collect();

        foreach ($services as $service) {
            if($service->service == '1'){
                $service_requests = $service_requests->merge($service->service_requests);
            }
            if($service->service == '0'){
                $job_requests = $job_requests->merge($service->service_requests);
            }
        }

        return view ("partner.index", compact('categories', 'service_partner', 'services', 'service_requests', 'job_requests'));
    }

}