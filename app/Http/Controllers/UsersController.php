<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Cart;

use Auth;
use Session;
use DB;
class UsersController extends Controller{
    public function UserLoginRegister(){

         return view('users.login_register');

   }

   public function login(Request $request){
       if($request->isMethod('post')){
            $data =  $request->all();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'] ])){
                $userStatus =User::where('email',$data['email'])->first();
                if($userStatus->status == 0 ){
                    return redirect()->back()->with('flash_message_error','Your Account is Not Activated! Confirm your email to activate.');

                }
                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id'))){
                   $session_id = Session::get('session_id');
                   DB::table('cart')->where('session_id', $session_id )->update(['user_email' => $data['email']]);
                }
                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username or Password!');

            }

       }

   }

   public function confirmAccount($email){
      $email = base64_decode($email);
      $userCount = User::where('email',$email)->count();
      if($userCount > 0){
          $userDetails = User::where('email',$email)->first();
          if($userDetails->status == 1){
              return redirect('login-register')->with('flash_message_Success','You Email account is already activated. You can login Now');
          }else {
              User::where('email',$email)->update(['status' => 1]);
              $messageData = ['email' => $email, 'name' => $userDetails->name, 'code' => base64_encode($email)];
              Mail::send('emails.welcome',$messageData,function($message) use($email){
                  $message->to($email)->subject('Welcome to E-com Account');
              });
              return redirect('login-register')->with('flash_message_Success','You Email account is activated. You can login Now');

          }

      }else {
          abort(404);
      }
   }

    public function register(Request $request){
        if($request->isMethod('post')){
           $data =  $request->all();
           //echo "<pre>";print_r( $data);die;
           // Check if User already exists
           $userCount = User::where('email',$data['email'])->count();
           if($userCount > 0 ){
               return redirect()->back()->with('flash_message_error','Email already exists!');
           }else{
               $user = new User;
               $user->name = $data['name'];
               $user->email = $data['email'];
               $user->password = bcrypt($data['password']);
               $user->save();


               // Send Confirmation Email
               $email = $data['email'];
             //  $messageData = ['email' => $data['email'], 'name' => $data['name'], 'code' => base64_encode($data['email'])];
               //Mail::send('emails.confirmation',$messageData,function($message) use($email){
                 //  $message->to($email)->subject('confirmation With E-com Account');
               //});

                return redirect()->back()->with('flash_message_Success','Please Confirm Your email to activate Your Account!');


               if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'] ])){
                   Session::put('frontSession',$data['email']);
                   if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id', $session_id )->update(['user_email' => $data['email']]);
                 }
                   return redirect('/cart');
               }

           }
        }
    }


    public function forgot_password(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $usercount = User::where('email',$data['email'])->count();
            if($usercount  == 0 ){
                return redirect()->back()->with('flash_message_error','Email does not exists!');

            }
            // Get User Details
            $userDetails  = User::where('email',$data['email'])->first();
            //Generate Random Password
            $random_password = str_random(8);
            // Encode/Secure Password
            $new_password = bcrypt($random_password);
            // Update Password
            User::where('email',$data['email'])->update(['password' => $new_password ]);
            //Send Forgot Password Email Script
            $email = $data['email'];
            $name = $userDetails->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $random_password
            ];
            Mail::send('emails.forgotpassword',$messageData,function($message) use($email){
                $message->to($email)->subject('New Password -  DefactO Website');
            });
            return redirect()->back()->with('flash_message_Success','Please Check Your Email For New Password!');

        }

        return view('users.forgot_password');

    }


    public function account(Request $request){
        $countries = Country::get();
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);

            if(empty($data['name'])){
                return redirect()->back()->with('flash_message_error','Please Enter  Name To update Your account details!');

            }
            if(empty($data['address'])){
                $data['address'] = "";
            }
            if(empty($data['city'])){
                $data['city'] = "";
            }
            if(empty($data['state'])){
                $data['state'] = "";
            }
            if(empty($data['country'])){
                $data['country'] = "";
            }
            if(empty($data['pincode'])){
                $data['pincode'] = "";
            }
            if(empty($data['mobile'])){
                $data['mobile'] = "";
            }
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_Success','Your account details has been successfully!');


        }
        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data =  $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password, $check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;

        }
        //echo "<pre>";print_r($data);die();
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data =  $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd, $old_pwd->password)){
                 // Update Password
                 $new_pwd = bcrypt($data['new_pwd']);
                 User::where('id',Auth::User()->id)->update(['password' =>  $new_pwd ]);
                 return redirect()->back()->with('flash_message_Success','Password Updated successfuly!');


            }else{
                return redirect()->back()->with('flash_message_error','Cuurent Password Is incorrecto!');

            }
        }
    }
    public function CheckEmail(Request $request){
            $data =  $request->all();
            // Check if User already exists
            $userCount = User::where('email',$data['email'])->count();
            if($userCount > 0 ){
                echo "false";

            }else{
                 echo "true";die;
            }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }

    public function viewUsers(){
        $users = User::get();
        return view('admin.users.view_users')->with(compact('users'));

    }
}
