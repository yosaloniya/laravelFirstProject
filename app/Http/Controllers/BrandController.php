<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
   public function index(){
     $data=Brand::all();
    return view('brand.index',compact('data'));
   }

   public function info(){
      return view('brand.info');
   }

   public function edit($id){
      $data=Brand::find($id);
      return view('brand.edit',compact('data'));
   }

   public function save(Request $req){
      $data=new Brand();
      $data->brand=$req->brand;
      $data->description=$req->description;
      $data->status=$req->status;
      if ($data->save()) {
         return redirect('brand')->with('success', 'Brand Saved Successfully');
      } else {
         return back()->with('error', 'Brand not Saved');
      }
   }
   
   public function edit1(Request $req,$id){
      $data=Brand::find($id);
      $data->brand=$req->brand;
      $data->description=$req->description;
      $data->status=$req->status;
      if ($data->update()) {
         return redirect('brand')->with('success', 'Brand Updated Successfully');
      } else {
         return back()->with('error', 'Brand not Updated');
      }
   }

   public function delete($id){
      $data=Brand::find($id);
      $data->delete();
      return back();
   }
public function status($id){
   $data=Brand::find($id);
   if ($data->status==1) {
      $data->status=0;

   }else {
      $data->status=1;
   }
     if ($data->update()) {
         return back ()->with('success', 'Status Updated Successfully');
      } else {
         return back()->with('error', 'Status not Updated');
      }
}
}
