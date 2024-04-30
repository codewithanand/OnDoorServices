<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServicePartner;
use App\Models\Category;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(){
        $categories = Category::all();
        $service_partner = ServicePartner::where('user_id', auth()->user()->id)->first();
        $services = Service::where('service_partner_id', $service_partner->id)->get();
        return view("partner.service", compact('categories', 'service_partner', 'services'));
    }

    public function store(Request $request, $id)
    {
        $newService = new Service;
        $newService->title = $request->title;
        $newService->service_partner_id = $id;
        $newService->category_id = $request->category_id;
        $newService->description = $request->description;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/service/',$filename);
            $newService->image = $filename;
        }
        $newService->save();
        return redirect()->back();
    }

    public function destroy($id){
        $service = Service::find($id);
        if($service){
            $service->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
