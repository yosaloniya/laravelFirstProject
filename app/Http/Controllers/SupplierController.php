<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Subsku;
class SupplierController extends Controller
{
    public function index(){
        $data=Supplier::all();
        return view('suppliers.index',compact('data'));
    }

    public function info(Request $request){
        $data = New Supplier();
        $data->invoice_no=$request->invoice_no;
        $data->name=$request->name;
        $data->contact=$request->contact;
        $data->description=$request->description;
        $data->status=$request->status;
        if ($data->save()) {
            return back()->with('success', 'Supplier Saved Successfully');
        } else {
            return back()->with('error', 'Supplier not Saved');
        }
    }

    public function data(Request $request){
        $sup = Supplier::find($request->id);
        return $sup;
    }

    public function update(Request $request){
        $data = Supplier::find($request->id);
        $data->invoice_no=$request->invoice_no;
        $data->name=$request->name;
        $data->contact=$request->contact;
        $data->description=$request->description;
        $data->status=$request->status;
        if ($data->update()) {
            return back()->with('success', 'Supplier Updated Successfully');
        } else {
            return back()->with('error', 'Supplier not Updated');
        }
    }

    public function delete($id){
        $data = Supplier::find($id);
        $data->delete();
        return back();
    }

    public function status($id){
        $data = Supplier::find($id);
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
    public function sup_products(Request $req){
        $data = product::where("sup_id", $req->id)->get();
        $data = $data->toArray();
        // print_r($data);
        $output = array();
        if(count($data) !=0) {
            $i=0;
            foreach ($data as $value) {
                $id = $value["id"];
                $subSku = Subsku::where("product_id", $id)->get();
                $subSku = $subSku->toArray();
                if(!empty($subSku)) {
                    $output = array_merge($output, $subSku);
                }else{

                    array_push($output, $data[$i]);
                }
                $i++;
            }
        }
        return $output;
   
    }
  
}
