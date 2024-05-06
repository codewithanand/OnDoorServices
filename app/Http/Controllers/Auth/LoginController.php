<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\ServicePartner;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        if(auth()->user()->role=="1"){
            return redirect("/admin/dashboard");
        }
        else if(auth()->user()->role=="2"){
            $service_partners = ServicePartner::where('user_id', auth()->user()->id)->get();
            if(count($service_partners) > 0){
                return redirect('/partner/dashboard');
            }
            return redirect('/register/partner');
        }
        else if(auth()->user()->role=="3")
        {
            return redirect("/seeker/dashboard");
        }
        else
        {
            return redirect("/profile");
        }
    }
}
