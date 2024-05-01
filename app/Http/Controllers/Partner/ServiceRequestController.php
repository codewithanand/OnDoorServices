<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function update($id){
        $service_request = ServiceRequest::find($id);
        if($service_request){
            $service_request->status = 1;
            $service_request->update();
            return redirect()->back()->with("success", "Service request updated successfully");
        }
        else{
            return redirect()->back()->with("success", "Service request not found");
        }
    }
}
