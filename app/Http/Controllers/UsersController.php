<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $data = User::all();
        return view('users.index',compact('data'));
    }
    public function info(Request $request){
        $data=new User();
         $data->user_id=$request->user_id;
         $data->name=$request->name;
         $data->email=$request->email;
         $data->fname=$request->fname;
         $data->sex=$request->sex;
         $data->phone=$request->phone;
         
         if($request->hasfile('image'))
         {
             $file = $request->file('image');
             $extenstion = $file->getClientOriginalExtension();
             $filename = time().'.'.$extenstion;
             $file->move('uploads/', $filename);
             $data->image = $filename;
            }
            $data->address=$request->address;
            $data->role=$request->role;
            $data->dob=$request->dob;
            $data->doj=$request->doj;
            $data->status=$request->status;
            $data->password=$request->password;
            if ($data->save()) {
                return back()->with('success', 'User saved Successfully');
            } else {
                return back()->with('error', 'User not saved');
            }
    }
    public function data(Request $request){
        $user=User::find($request->id);
        return $user;
    }
   
    public function update(Request $request){
        $data = User::find($request->id);
         $data->name=$request->name;
         $data->email=$request->email;
         $data->fname=$request->fname;
         $data->sex=$request->sex;
         $data->phone=$request->phone;
         
         if($request->hasfile('image'))
         {
             $file = $request->file('image');
             $extenstion = $file->getClientOriginalExtension();
             $filename = time().'.'.$extenstion;
             $file->move('uploads/', $filename);
             $data->image = $filename;
            }else{
                $data->image=$request->img;
            }
            $data->address=$request->address;
            if ($data->update()) {
                return back()->with('success', 'User Updated Successfully');
            } else {
                return back()->with('error', 'User not Updated');
            }
    }

    public function delete($id){
        $data=User::find($id);
        $path = public_path()."/"."uploads/".$data->image;
        unlink($path);
        $data->delete();
        return back();
    }

    public function status($id){
        $data = User::find($id);
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