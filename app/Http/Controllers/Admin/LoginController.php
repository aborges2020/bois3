<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Auth;
// use Illuminate\Foundation\Auth\ThrottlesLogins;
// use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Form for login in admin area  
     * @return [view] [description]
     */
    public function showLoginForm()
    {
      //var_dump(Auth()->check());
      //die;

      // if (auth()->check()) {
      //   return redirect('/admin');
      // }

      return view('admin.auth.login');
    }
    
    /**
     * [login description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(Request $request)
    {
      // // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:4'
      ]);
      
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email'    => $request->email, 
                                         'password' => $request->password, 
                                         'active'   => 1], $request->remember)) {

        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      //return redirect()->back()->withInput($request->only('email', 'remember'));
      return $this->sendFailedLoginResponse($request);
       
      // $this->validateLogin($request, ['email'    => 'required|email', 
      //                                 'password' => 'required|4'
      //                               ]);

      // if (Auth::guard('admin')->attempt(['email'    => $request->email, 
      //                                    'password' => $request->password, 
      //                                    'active'   => 1], 
      //                                    $request->remember)) {
      //   //The user is active, not suspended, and exists.
      //   return $this->sendLoginResponse($request);
      // }

      // return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * Admin logout 
     * @return [type] [description]
     */
    public function logout(Request $request)
    {
      // $this->guard()->logout();
      // //$request->session()->invalidate();
      // return redirect('admin/');

      Auth::guard('admin')->logout();
      return redirect('/admin');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
