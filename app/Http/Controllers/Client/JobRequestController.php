<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;

class JobRequestController extends Controller
{
    public function index($id){
        if(auth()->user()->role != 0){
            return redirect()->back()->with("error", "You are not authorized");
        }
        $job = Service::find($id);
        return view ("user.job.index", compact("job"));

    }

    public function store(Request $request, $id){
        
    }
}
