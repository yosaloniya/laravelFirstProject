<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
class CategoryController extends Controller
{
    public function index(){
        $data = Category::all();
       return view('category.index',compact('data'));
      }

      public function info(){
         $brand=Brand::select('brand','id')->where('status',1)->get();
         return view('category.info',compact('brand'));
      }

      public function edit($id){
         $data=Category::find($id);
         $brand=Brand::select('brand','id')->where('status',1)->get();
         return view('category.edit',compact('data','brand'));
      }

      public function save(Request $req){
         $data=new Category();
         $data->brand_id=$req->brand_id;
         $data->name=$req->name;
         if($req->hasfile('image'))
        {
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $data->image = $filename;
        }
         $data->description=$req->description;
         $data->status=$req->status;
         if ($data->save()) {
            return redirect('category')->with('success', 'Category Saved Successfully');
         } else {
            return back()->with('error', 'Category not Saved');
         }
      }

      public function edit1(Request $req,$id){
         $data=Category::find($id);
         $data->brand_id=$req->brand_id;
         $data->name=$req->name;
         if($req->hasfile('image'))
        {
         // $path = public_path()."/"."uploads/".$data->image;
         // unlink($path);
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $data->image = $filename;
        }else {
         $data->image = $req->img;
        }
         $data->description=$req->description;
         $data->status=$req->status;
         if ($data->update()) {
            return redirect('category')->with('success', 'Category Updated Successfully');
         } else {
            return back()->with('error', 'Category not Updated');
         }
      }

      public function delete($id){
         $data=Category::find($id);
         $path = public_path()."/"."uploads/".$data->image;
         unlink($path);
         $data->delete();
         return back();
      }
      public function status($id){
         $data=Category::find($id);
         if ($data->status==1) {
            $data->status=0;
         }else {
            $data->status=1;
         }
           if ($data->update()) {
            return redirect('category')->with('success', 'Status Updated Successfully');
         } else {
            return back()->with('error', 'Status not Updated');
         }
      }
      
}