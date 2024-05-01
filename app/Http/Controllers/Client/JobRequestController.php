<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobRequestController extends Controller
{
    public function store(Request $request, $id){
        if(auth()->user()->role != 0){
            return redirect()->back()->with("error", "You are not authorized");
        }
    }
}
