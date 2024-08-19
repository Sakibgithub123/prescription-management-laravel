<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use DB;
use Illuminate\Support\Str;

// https://www.itsolutionstuff.com/post/laravel-custom-forgot-reset-password-exampleexample.html#google_vignette
class ForgetPasswordController extends Controller
{
    //
    public function showForgetPasswordForm(){
        return view('frontEnd.forget-password.forget-password-form');

    }

    public function submitForgetPasswordForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('frontEnd.forget-password.forget-password-email', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        $data=[];
        $data['response_code']='200';
        $data['status']='success';
        $data['message']='Check your email.Reset passwor link send success!';

        return response()->json($data);
    }

    public function showResetPasswordForm($token) { 
        return view('frontEnd.forget-password.forget-password-link', ['token' => $token]);
     }


     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6',
            //  'password' => 'required|string|min:6|confirmed',
            //  'password_confirmation' => 'required'
         ]);
 
         $updatePassword = DB::table('password_reset_tokens')
                             ->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])
                             ->first();
 
         if(!$updatePassword){
            //  return back()->withInput()->with('error', 'Invalid token!');
             return response()->json(['status'=>false,'message'=>'fail']);
         }
 
         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
 
        //  return redirect('/login')->with('message', 'Your password has been changed!');
        return response()->json(['status'=>true,'message'=>'success']);
     }


}
