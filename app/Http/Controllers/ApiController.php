<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function index(){
        $data=User::select('id as user_id','name as title','email')->get();
        return response(['status'=>'200','data'=>$data]);
    }
    public function info(Request $request){
        return $request->all();
    }
}
