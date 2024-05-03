<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();
        $categories = Category::all();
        return view ("admin.service.index", compact('categories', 'services'));
    }

    public function store(Request $request){
        $service = new Service;
        $service->category_id = $request->category_id;
        $service->title = $request->title;
        $service->description = $request->description;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/service/',$filename);
            $service->image = $filename;
        }
        $service->save();
        return redirect()->back()->with("success", "Service created successfully");
    }
}
