<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServicePartner;

use App\Models\Category;


class PartnerController extends Controller
{
    public function index(){
        $categories = Category::all();

        $user_id = auth()->user()->id;
        $service_partner = ServicePartner::where('user_id', $user_id)->first();
        $services = Service::where('service_partner_id', $service_partner->id)->get();

        return view ("partner.index", compact('categories', 'service_partner', 'services'));
    }

    public function store(Request $request){
        
    }
}
