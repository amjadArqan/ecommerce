<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Admin;

use Session;

class AdminController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')){
            $data = $request->input();
            $adminCount = Admin::where(['username'=> $data['username'] ,'password' => md5($data['password']), 'status' => 1])->count();
            if($adminCount > 0){
                Session::put('adminSession',$data['username']);
                return redirect('/admin/dashboard');
            }else{
                echo 'Fiald';
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');

            }

        }
        return view('admin.admin_login');
    }


    public function register(Request $request){
        if($request->isMethod('post')){
            $admin_new = new Admin;
            $admin_new->username = $request->username;
            $admin_new->email = $request->email;
            $admin_new->password = md5($request->password);
            $admin_new->save();
            return redirect('/admin')->with('flash_message_Success','Create Admin Is Successfuly !');


        }

        return view('admin.admin_register');

    }


    public function dashboard(){
            return view('admin.dashboard');
    }
    public function settings(){
        $adminDetails = Admin::where(['username' => Session::get('adminSession')])->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $adminCount = Admin::where(['username'=>Session::get('adminSession') ,'password' => md5($data['current_pwd'])])->count();

        if($adminCount == 1){
            echo "true"; die;
     }else {
            echo "false"; die;
     }
    

    }
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $adminCount = Admin::where(['username'=>Session::get('adminSession') ,'password' => md5($data['current_pwd'])])->count();

            if($adminCount == 1){

                $password = md5($data['new_pwd']);
                Admin::where('username',Session::get('adminSession'))->update(['password' => $password]);
                return redirect('/admin/settings')->with('flash_message_success','Password Update Successfully !');

         }else {
            return redirect('/admin/settings')->with('flash_message_error','Incorrect  Current Password !');

         }
            
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_Success','Logged out Successfully');
    }


}


