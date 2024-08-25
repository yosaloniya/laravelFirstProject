<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subsku;
use App\Models\Supplier;


class ProductController extends Controller
{
  public function index(){
    $data = Product::all();
    return view('product.index',compact('data'));
  }

  public function info(){
    $category = Category::select('name','id')->where('status',1)->get();
    $supplier = Supplier::select('name','id')->where('status',1)->get();
    return view('product.info',compact('category','supplier'));
  }

  public function save(Request $req){
    $data=new Product();
    $data->category_id=$req->category_id;
    $data->sup_id=$req->sup_id;
    $data->name=$req->name;
    $data->sku=$req->sku;

    if($req->hasfile('image'))
   {
       $file = $req->file('image');
       $extenstion = $file->getClientOriginalExtension();
       $filename = time().'.'.$extenstion;
       $file->move('uploads/', $filename);
       $data->image = $filename;
   }
    $data->t_price=$req->t_price;
    $data->r_price=$req->r_price;
    $data->description=$req->description;
    $data->qty=$req->qty;
    $data->location=$req->location;
    $data->status=$req->status;
    if ($data->save()) {
      return redirect('products')->with('success', 'Product Saved Successfully');
    } else {
      return back()->with('error', 'Product not Saved');
    }
 }

 public function edit($id){
  $data = Product::find($id);
  $category = Category::select('name','id')->where('status',1)->get();
  $supplier = Supplier::select('name','id')->where('status',1)->get();
  return view('product.edit',compact('data','category','supplier'));
 }

 public function edit1(Request $req,$id){
  $data=Product::find($id);
  $data->category_id=$req->category_id;
  $data->sup_id=$req->sup_id;
  $data->name=$req->name;
  $data->sku=$req->sku;

  if($req->hasfile('image'))
 {
     $file = $req->file('image');
     $extenstion = $file->getClientOriginalExtension();
     $filename = time().'.'.$extenstion;
     $file->move('uploads/', $filename);
     $data->image = $filename;
 }else {
  $data->image = $req->img;
 }
  $data->t_price=$req->t_price;
  $data->r_price=$req->r_price;
  $data->description=$req->description;
  $data->qty=$req->qty;
  $data->location=$req->location;
  $data->status=$req->status;
  if ($data->update()) {
    return redirect('products')->with('success', 'Product Updated Successfully');
  } else {
    return back()->with('error', 'Product not Updated');
  }
}

public function delete($id) {
  $data = Product::find($id);
  
  if (!$data) {
      return back()->with('error', 'Product not found');
  }

  $data1 = Subsku::where('product_id', $id)->get();
  
  $path = public_path()."/uploads/".$data->image;
  if (file_exists($path)) {
      unlink($path);
  }

  if ($data->delete()) {
      foreach ($data1 as $subsku) {
          $subsku->delete();
      }
      return back();
  } else {
      return back()->with('error', 'Product not deleted');
  }
}


public function subsku() {
  
} 

public function status($id){
  $data = Product::find($id);
  if ($data->status==1) {
    $data->status=0;
  } else {
    $data->status=1;
  }
  if ($data->update()) {
    return redirect('products')->with('success', 'Status Updated Successfully');
  } else {
    return back()->with('error', 'Status not Updated');
  }
}

public function data(Request $req){
  $data = Subsku::where('product_id',$req->id)->get();
  return $data;
}
}