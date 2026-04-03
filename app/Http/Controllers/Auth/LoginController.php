<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Auth;
use App\Mail\EmailOtp;
use Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function verify_otp(Request $request){
        $credentials = $request->only('email', 'password','_token');
        if($user = User::where('email',$credentials['email'])->first()){
            if(Hash::check($credentials['password'], $user->password)){
                if($user->status == 1){
                    $user->otp = rand(1000,9999);
                    $user->update();

                    $data = [
                        'otp' => $user->otp,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                    ];
                    $recipients = [
                        'aasha.ashok0750@gmail.com',
                        'Js.9814366050@gmail.com',
                        'Parth.naav9@gmail.com',
                    ];
                    // Mail::to($recipients)->send(new EmailOtp($data));
                   
                    // return response()->json(['login'=>'need_otp']);
                    return response()->json(['login'=>'sucess']);
                }
               
                else{
                    return response()->json(['login'=>'failed']);
                }
            }
           
        }
        else{
            return response()->json(['login'=>'failed']);
        }
    }
    public function check_otp(Request $request){
        $credentials = $request->only('email', 'otp','_token');
        $user = User::where('email',$credentials['email'])->first();
        if($user){
            if($credentials['otp'] == $user->otp){

                $user->otp = '';
                $user->update();
                return response()->json(['success'=>1]);
            }
            else{
                return response()->json(['success'=>0]);
            }
        }
    }
    protected function redirectTo()
    {
        $user = auth()->user();
        switch ($user->role_as) {
            case 'Admin':
                return RouteServiceProvider::ADMIN_HOME;
            case 'Stock_Management':
                return RouteServiceProvider::STOCK_HOME;
            case 'Order_Stock_Management':
                return RouteServiceProvider::STOCK_HOME;
            case 'Order_Management':
                return RouteServiceProvider::ORDER_HOME;
            case 'Purchase_Management':
                return RouteServiceProvider::PURCHASE_HOME;
            default:
                return RouteServiceProvider::HOME;
        }
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password','_token');
        
       if($user = User::where('email',$credentials['email'])->first()){
        if(Hash::check($credentials['password'], $user->password)){
            if($user->status == 1){
                Auth::loginUsingId($user->id);
                return redirect()->intended(url($this->redirectTo()));
            }
            else{
                return redirect()->route('login')->with('status','You have been deactivated')->withInput();
            }
        }
        else{
            return redirect()->route('login')->with('status','Incorrect Password.Please Try Again')->withInput();
        }
       }
       else{
        return redirect()->route('login')->with('status','Incorrect Email or Password. Please Try Again')->withInput();
       }
    }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
