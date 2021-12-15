<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        if(Auth::check()){
            auth::logout();
            return redirect()->route('register')
                         ->with('success','Succesfuly registered, You can login now');

        }
        else{
            auth::logout();
            return view('auth.login');
        }
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
    public function admin(){
        return view('adminBlades.adminHome');
    }
}


