<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    
    //protected $redirectTo = RouteServiceProvider::MYACCOUNT;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Function login validation
     * 
     * @return void
     */
    public function login(Request $request)
    {
        // // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4'
        ]);
      
        // Attempt to log the user in
        if (Auth::guard('web')->attempt([
                'email'    => $request->email, 
                'password' => $request->password, 
                'active'   => 1], 
                $request->remember)) 
        {
            // if successful, then redirect to:
            // if cart exist in session redirect to cart else redirect to my account route
            if(session()->get('cart')){
                return redirect()->intended(route('cart'));
            }else{
                // Or redirect to checkout...
                return redirect()->intended(route('my.account'));
            }
        } 
        // if unsuccessful, then redirect back to the login with the form data
        //return redirect()->back()->withInput($request->only('email', 'remember'));
        return $this->sendFailedLoginResponse($request);
    }
    
    public function logout() 
    {
        Auth::logout();

        return redirect('/');
    }
}
