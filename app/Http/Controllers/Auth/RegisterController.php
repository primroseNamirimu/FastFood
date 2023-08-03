<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
       return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
                     'firstname' => $data['firstname'],
                     'lastname' => $data['lastname'],
                     'username' => $data['username'],
                     'phone' => $data['phone'],
                     'email' => $data['email'],
                     'password' => Hash::make($data['password']),
                 ]);


    }

//    public function register(Request $request)
//    {
//
//        $validator = $this->validator($request->all());
//
//        if ($validator->fails()) {
////            dd("failed");
//            return redirect()->route('register')
//                ->withErrors($validator);
//        }
//
//        event(new Registered($user = $this->create($request->all())));
//
//        $this->guard()->login($user);
//
//        if ($response = $this->registered($request, $user)) {
//            return $response;
//        }
//
//    }
    protected function registered(Request $request, $user): RedirectResponse
    {

            return redirect()->route('login')->with('success', 'Hooray!! Registration successful. You can log in now.');

    }
}
