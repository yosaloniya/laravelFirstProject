<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subsku;
use App\Models\Supplier;

use Session;
class SubskuController extends Controller
{
    public function info($id){
        $supplier = Supplier::select('name','id')->where('status',1)->get();
        return view('subsku.info',compact('supplier'));
    }
    public function save(Request $req,$id){
        $data = New Subsku();
        $data->product_id=$id;
        $data->name=$req->name;
        $data->sup_id=$req->sup_id;
        $data->sku=$req->sku;
        if($req->hasfile('image'))
        {
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $data->image = $filename;
        }
        $data->colour=$req->colour;
        $data->t_price=$req->t_price;
        $data->r_price=$req->r_price;
        $data->size=$req->size;
        $data->qty=$req->qty;
        $data->description=$req->description;
        $data->status=$req->status;
        $data->location=$req->location;
        if ($data->save()) {
            return redirect('subsku/'.$id)->with('success', 'Skudata Saved Successfully');
        }else {
            return back()->with('error', 'Skudata not Saved');
        }
        
        
    }
    public function index($id){
        $data = Subsku::where('product_id',$id)->get();
        return view('subsku.index',compact('data','id'));
    }
    public function delete($id){
        $data = Subsku::find($id);
        $path = public_path()."/"."uploads/".$data->image;
               unlink($path);
        $data->delete();
        return back();
    }
    public function edit($id){
        $data = Subsku::find($id);
        $supplier = Supplier::select('name','id')->where('status',1)->get();
        return view('subsku.edit',compact('data','supplier'));
    }
    public function edit1(Request $req,$id){
        $data = Subsku::find($id);
        $data->product_id=$req->product_id;
        $data->name=$req->name;
        $data->sup_id=$req->sup_id;
        $data->sku=$req->sku;
        if($req->hasfile('image'))
        {
            $file = $req->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/', $filename);
            $data->image = $filename;
        }
        $data->colour=$req->colour;
        $data->t_price=$req->t_price;
        $data->r_price=$req->r_price;
        $data->size=$req->size;
        $data->qty=$req->qty;
        $data->status=$req->status;
        $data->description=$req->description;
        $data->location=$req->location;
        ;
        if ($data->update()) {
            return redirect('subsku/'.$data->product_id)->with('success', 'Skudata Updated Successfully');
        } else {
            return back()->with('error', 'Skudata not Updated');
        }
        
    }
    public function status($id){
        $data = Subsku::find($id);
        if ($data->status==1) {
            $data->status=0;
        } else {
            $data->status=1;
        }
        if ($data->update()) {
            return back()->with('success', 'Status Updated Successfully');
        } else {
            return back()->with('error', 'Status not Updated');
        }
    }
 
}
