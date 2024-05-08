<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view ("admin.category.index", compact('categories'));
    }

    public function store(Request $request){
        $category = new Category;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title);
        $category->description = $request->description;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->save();
        return redirect()->back()->with("success", "Category created successfully");
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if($category){
            $category->title = $request->title;
            $category->slug = Str::slug($request->title);
            $category->description = $request->description;
            if($request->hasfile('image')){
                $destination = 'uploads/category/'.$category->image;
                if(File::exists($destination)){
                    File::delete($destination);
                }

                $file = $request->file('image');
                $filename = time().'.'.$file->getClientOriginalExtension();
                $file->move('uploads/category/',$filename);
                $category->image = $filename;
            }
            $category->update();
            return redirect()->back()->with("success", "Category updated successfully");
        }
        return redirect()->back()->with("error", "Category not found");
    }

    public function destroy($id){
        $category = Category::find($id);
        if($category){
            $destination = 'uploads/category/'.$category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $category->delete();
            return redirect()->back()->with("success", "Category deleted successfully");
        }
        return redirect()->back()->with("error", "Category not found");
    }
}
