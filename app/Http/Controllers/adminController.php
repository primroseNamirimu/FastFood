<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $users = DB::select('select * from users where is_disabled = ?', [0]);
        //dd($users);


        return view ('userBlades.team',["users"=>$users],['user.adminHome',["users"=>$users]]);
    }

    public function disabledUsers(){

        $disabledUsers = DB::select('select * from users where is_disabled=?', [1]);
        return view('userBlades.disabledUsers', ["disabledUsers" => $disabledUsers]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'phone' =>['required','numeric','min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $q = User::create([
            'firstname' => $request['firstname'],
            'lastname' =>$request['lastname'],
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        if($q){
            return redirect()->route('admin-actions.index')
                ->with('success','User created successfully.');
        }
        else {
            return redirect()->route('admin-actions.index')
                ->with('danger',"Oops.. It's us not you. Something went wrong. Please try again.");
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id

     */
    public function show($id)
    {
        $user= User::find($id);
        return view('userBlades.profile',compact('user'),["user"=>$user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update (Request $request, $id)
    {

        $user = User::find($id);
        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->username = request('username');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->save();
                $request->validate([
                'firstname' => 'required', 'string', 'max:255',
                'lastname' => 'required', 'string', 'max:255',
                'username' => 'required', 'string', 'max:255',
                'phone' => 'required','numeric','min:10',
                'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
         ]);
        $user ->update($request->all());

  if (Auth::user()->is_admin==1){

    return redirect()->route('admin-actions.index')
    ->with('success','Profile updated successfully');
  }
  return redirect()->route('admin-actions.show',Auth::user()->id)
  ->with('success','Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //User::find($id)->delete();
       $disabledUser = User::find($id);
       if($disabledUser->is_disabled==0){

            $disabledUser->is_disabled = '1';
            $disabledUser->save();
            return redirect()->route('admin-actions.index')
            ->with('success','User disabled successfully');

       }
       else{

        $disabledUser->is_disabled = '0';
        $disabledUser->save();
        return redirect()->route('admin-actions.index')
        ->with('success','User enabled successfully');
       }



    }

    public function enableUser($id)
    {
        //User::find($id)->delete();
       $enableUser = User::find($id);
       if($enableUser){
            $enableUser->is_disabled = '0';
            $enableUser->save();
       }


        return redirect()->route('admin-actions.index')
                        ->with('success','User enabled successfully');
    }

    //changing password functionality


/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changePassword(Request $request){
        $id = Auth::user()->id;
        $user = User::find($id);

        if($user && isset($_GET['change'])){

            $old_password = $_GET['old_password'];
            if(Hash::check($old_password,$user->password)){
                $new_password = $_GET['password'];
                $confirm_password = $_GET['confirm_password'];

                if($new_password == $confirm_password){
                 $user->password = request('password');
                 $user->save();
                 echo("i reach here");
                 $request->validate($request,[
                    'password' => ['required', 'alpha_num', 'min:8', 'confirmed'],
                 ]);

            //      $request->validate([

            //          'password' => Hash::make($request['password']),
            //   ]);

              $user->update(['password'=>Hash::make($request['password'])]);
              if($user){
                echo("i reach here updated");
              }

                }else{
                    echo("paswords do not match");
                }

        //  return redirect()->route('admin.home')
        //                  ->with('success','password changed successfully');
            }else{
                echo("bottom");

                // return redirect()->route('admin.home')
                // ->with('danger','Wrong old password');

            }
        }
    }


    public function destroyMultiple($id)
    {
        // $IDs = [];
        // $IDs->request($id);
        // foreach ($IDs as $id) {
        //     User::find($id)->delete();
        // }


        // return redirect()->route('admin-actions.index')
        //                 ->with('success','Users deleted successfully');
    }
}
