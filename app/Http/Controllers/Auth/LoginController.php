<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use app\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {

            Auth::user()->is_admin;
            if (Auth::user()->is_admin ) {
                return redirect()->route('admin.home');
            }
            else {
                return redirect()->route('userhome');
            }
        }
        else {

            return back()->with('fail', 'Wrong credentials, try again!');

        }

    }
}
