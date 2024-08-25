<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Supplierproduct;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Subsku;

class SupplierproductController extends Controller
{
    public function index(){
        $data = Supplierproduct::all();
        return view('supplierproduct.index',compact('data'));
    }
    public function info(){
        $product=Product::select('name','sku','id')->where('status',1)->get();
        $product1=Subsku::select('name','sku','id')->where('status',1)->get();
        $supplier=Supplier::select('name','id')->where('status',1)->get();
        return view('supplierproduct.info',compact('product','supplier','product1'));
    }
    public function save(Request $req){
      try {
        //code...
 
        
      $data=New Supplierproduct();
      $data->product_id=$req->id;
      $data->sup_id=$req->sup_id;
      $data->sku = $req->sku;
      $data->sub_sku = $req->sub_sku;
      $data->qty=$req->qty;
      $i=1;
      if($req->sub_sku =="Not Found" || $req->sub_sku =="none"){
        $product=Product::find($req->id);
        $qty=$product->qty+$req->qty;
        $product->qty=$qty;
        $i++;
      } else {
        $product=Subsku::where("sku", $req->sub_sku)->first();
        $qty = (int)$product->qty;
        $qty+= (int)$req->qty;
        // $product->qty=$qty;
        // return $productsku
    }
      // return $data;
      if($data->save()){
        if($i==1) {
          Subsku::where("sku", $req->sub_sku)->update(["qty" => $qty]);
        }else {
          $product->update();

        }
        // return redirect('supplierproducts');
        return "success";
      }else {
        return "error";
      }
    } catch (\Throwable $th) {
      //throw $th;
      return ["php" =>123, "message" => $th->getMessage()];
    }
    }

  
}
