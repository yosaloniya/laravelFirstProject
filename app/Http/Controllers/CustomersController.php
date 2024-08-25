<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Sales;
class CustomersController extends Controller
{
   public function index(){
     $data = customers::all();
    return view('customers.index',compact('data'));
   }

   public function info(Request $request){
      $data = new Customers();
      $data->name=$request->name;
      $data->contact=$request->contact;
      $data->address=$request->address;
      $data->status=$request->status;
      if ($data->save()) {
         return back()->with('success', 'Customer Saved Successfully');
      } else {
         return back()->with('error', 'Customer not Saved');
      }
   }

   public function customersorder($id){
      $data = Sales::where('customer_id',$id)->get();
      return view('customers.orders',compact('data'));
   }

   public function status($id){
      $data = Customers::find($id);
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

   public function data(Request $request){
     $customer = Customers::find($request->id);
     return $customer;
   }

   public function customerdatainfo(Request $req){
      $data = sales::where('customer_id',$req->id)->get();
      return $data;
   }

   public function update(Request $request){
      $data = Customers::find($request->id);
      $data->name=$request->name;
      $data->contact=$request->contact;
      $data->address=$request->address;
      $data->status=$request->status;
      if ($data->update()) {
         return back()->with('success', 'Customer Updated Successfully');
      } else {
         return back()->with('error', 'Customer not Updated');
      }
   }

   public function delete($id){
      $data = Customers::find($id);
      $data->delete();
      return back();
   }
}
