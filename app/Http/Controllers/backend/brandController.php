<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class brandController extends Controller
{
    public function index(){

        $brands=Brand::orderBy('id','DESC')->paginate(10);
        return view('backend.brands.index',compact('brands'));
    }

    public function create(){
        return view('backend.brands.create');
    }

    public function store(Request $request)
{        
    // dd($request->all());
     $request->validate([
          'name' => 'required',
          'slug' => 'required|unique:brands,slug',
          'image' => 'mimes:png,jpg,jpeg|max:2048'
     ]);

     $brand = new Brand();
     $brand->name = $request->name;
     $brand->slug = Str::slug($request->name);
     $image = $request->file('image');
     $file_extention = $request->file('image')->extension();
     $file_name = Carbon::now()->timestamp . '.' . $file_extention;    
     $this->GenerateBrandThumbailImage($image, $file_name);
     $brand->image = $file_name;        
     $brand->save();
     return redirect()->route('brands.list')->with('status','Record has been added successfully !');
}

public function GenerateBrandThumbailImage($image, $file_name){

    $destinationPath=public_path('uploads/backend/brands');
    $img=Image::read($image->path());
    $img->cover(124,124,"top");
    $img->resize(124,124 ,function($constraint){
        $constraint->aspectRatio();
    })->save($destinationPath.''.$file_name);

}
    
}
