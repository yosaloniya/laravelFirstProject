<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sales;
use App\Models\Customers;
use App\Models\Subsku;

class SalesController extends Controller
{
    public function index(){
        $data = Sales::all();
        foreach ($data as $product) {
            $product->product_id = unserialize($product->product_id);
        }
        return view('sales.index',compact('data'));
    }
    

    public function price(Request $request){
        $data=Subsku::where('id',$request->id)->value('t_price');
        return $data;
    }
    public function info(){
        $customer = Customers::select('name','id')->where('status',1)->get();
        $product = Product::select('name','t_price','id','sku')->where('status',1)->get();
        return view('sales.info',compact('product','customer'));
    }

    public function subsku(Request $req) {
        $id = $req->id;
        $subSku = Subsku::select('*')->where('product_id',$id)->get();
        if(count($subSku) !=0) {
            return $subSku;
        }
        return 201;
    }

    public function getPrice(Request $req) {
        $data = Product::find($req->id);
        return $data;
    }
    
    public function save(Request $req){
        try{
        $data = New Sales();
        $data->order_no=$req->order_no;
        $data->customer_id=$req->customer_id;
        $data->product_id=serialize($req->product);
        $data->payment_status=$req->payment_status;
        $data->total_payment=$req->total_payment;
        $data->due_payment=$req->due_payment;
        // $data->status=$req->status;
        $data->total_price = $req->total_price;
        $pIds = [];
        $productArr = [];
        foreach($req->product as $p){
            if(!empty($p["p_id"])) {
                $pdata=Subsku::find($p['p_id']);
                if ($p['qty']<=$pdata["qty"]) {
                    $pqty=$pdata["qty"];
                    $pQty=$pqty-$p['qty'];
                    $pIds[$p['p_id']] = $pQty;
                  
                }else{
                    // Session::flash('error', 'The Product quantity is invalid!');
                    return "The Product quantity is invalid!";
                }
            }else {
                $products = Product::find($p['sku']);
                if($products["qty"]>=$p['qty']){
                    $newQty = $products["qty"]-$p['qty'];
                    $productArr[$p['sku']] = $newQty;
                }else{
                    // Session::flash('error', 'The Product quantity is invalid!');
                    return "The Product quantity is invalid!";
                }
            }
        }
        if ($data->save()) {
            foreach($pIds as $pId => $qty) {
                $pData=Subsku::find($pId);
                $pData->qty = $qty;
                $pData->update();
            }
            foreach($productArr as $sku => $qty) {
                $pData = Product::find($sku);
    
                $pData->qty = $qty;
                $pData->update();
            }
            return ('success');
            
        } else {
            return ('error');
        }
        
    }  catch (\Exception $e) {
        // Log the error or return a response indicating the error
        // return "failed";
        return ["php" => 123, "msg" => $e->getMessage()];
    }
}


    public function edit($id){
        $data = Sales::find($id);
        $product1 = unserialize($data->product_id);
        $customer = Customers::select('name','id')->where('status',1)->get();
        $product = Product::select('name','t_price','id','sku')->where('status',1)->get();
        return view('sales.edit',compact('data','product','customer','product1'));
    }

    public function update(Request $req){
        try{
        $data =Sales::find($req->id);
        $data->order_no=$req->order_no;
        $data->customer_id=$req->customer_id;
        $data->product_id=serialize($req->product);
        $data->payment_status=$req->payment_status;
        $data->total_payment=$req->total_payment;
        $data->due_payment=$req->due_payment;
        // $data->status=$req->status;
        $data->total_price = $req->total_price;
        $pIds = [];
        $productArr = [];
        foreach($req->product as $p){
            // echo $p['p_id']
            if(!empty($p["p_id"])) {
                $pdata=Subsku::find($p['p_id']);
                if (abs($p['newQty'])<=$pdata["qty"]) {
                    $pqty=$pdata["qty"];
                    $pQty=$pqty+$p['newQty'];
                    $pIds[$p['p_id']] = $pQty;
                  
                }else{
                    // Session::flash('error', 'The Product quantity is invalid!');
                    return "The Product quantity is invalid!";
                }
            }else {
                $products = Product::find($p['sku']);
                if($products["qty"]>=abs($p['newQty'])){
                    $pqty = $products["qty"]+$p['newQty'];
                    $productArr[$p['sku']] = $pqty;
                }else{
                    return "The Product quantity is invalid!";
                }
            }
        }
        if ($data->update()) {
            foreach($pIds as $pId => $qty) {
                $pData=Subsku::find($pId);
                $pData->qty = $qty;
                $pData->update();
            }
            foreach($productArr as $sku => $qty) {
                $pData = Product::find($sku);
                $pData->qty = $qty;
                $pData->update();
            }
            return ('success');
        } else {
            return ('error');

        }
        
    }  catch (\Exception $e) {
        // Log the error or return a response indicating the error
        // return "failed";
        return ["php" => 123, "msg" => $e->getMessage()];
    }
    }

    

    public function delete($id){
        try {
            $data = Sales::find($id);
            $product = unserialize($data->product_id);
    
            foreach($product as $p) {
                if(!empty($p["p_id"])) {
                    $pdata=Subsku::find($p['p_id']);
                    $posQty = abs($p["qty"]);
                    $pdata->qty+= (int)$posQty;
                    $pdata->update();
                }else {
                    $products = Product::find($p['sku']);
                    $posQty = abs($p["qty"]);
                    $products->qty+= (int)$posQty;
                    $products->update();
                }   
            }   
    
            $data->delete();
            return redirect('orders');
        } catch (\Throwable $th) {
            return ["code" => 201, "message" => $th->getMessage()];
            //throw $th;
        }
    }
    public function pdf($id){
        $data = Sales::find($id);
    
        $product = unserialize($data->product_id);
       
        return view('pdf.index-3',compact('data','product'));
    }

    // public function savwertye(Request $req){
    //     // Create a new Sales instance
    //     try{
    
    //     $data = new Sales();
    //     $data->order_no = $req->order_no;
    //     $data->customer_id = $req->customer_id;
        
    //     // Instead of serializing, consider storing product IDs in an array
    //     $productIds = [];
    //     foreach ($req->product as $p) {
    //         $productIds[] = $p['p_id'];
            
    //         // Update product quantities
    //         $pdata = Subsku::find($p['p_id']);
    //         if ($pdata && $p['qty'] < $pdata->qty) {
    //             $pdata->qty -= $p['qty'];
    //             $pdata->update();
    //         } else {
    //             // If product quantity is insufficient, return with an error
    //             return back()->with('error', 'Insufficient quantity for this product');
    //         }
    //     }
        
    //     // Assign product IDs array to product_id field
    //     $data->product_id = json_encode($productIds);
    
    //     // Set other fields
    //     $data->payment_status = $req->payment_status;
    //     $data->total_payment = $req->total_payment;
    //     $data->due_payment = $req->due_payment;
    //     $data->status = $req->status;
    //     $data->save();
    //     return ["status" => 200, "message" => $data];
    //     // Save the sales data
    //     // if ($data->save()) {
    //     //     // If saved successfully, redirect to orders page
    //     //     return redirect('orders')->with('success', 'Data Saved Successfully.');
    //     // } else {
    //     //     // If saving fails, return with an error
    //     //     return back()->with('error', 'Failed to save data.');
    //     // }
    // }catch(/Exception $e) {
    //     // return response()->json(["error" => $e->getMessage()], 201);
    //     return ["status" => 201, "message" => $e.getMessage()];
    // }
    // }
}
