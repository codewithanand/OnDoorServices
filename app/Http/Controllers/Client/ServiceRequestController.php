<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function store(Request $request, $id){
        $service_request = new ServiceRequest;
        $service_request->name = $request->service_name;
        $service_request->contact = $request->service_contact;
        $service_request->address = $request->service_address;
        $service_request->service_id = $id;
        $service_request->save();
        return redirect()->back()->with("success", "Service request sent successfully");
    }

    
}
