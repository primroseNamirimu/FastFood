<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    // * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::all();
        //dd($users);

        $usersCount = User::where('is_admin','=','0')->count();
        //echo ($usersCount);

        return view ('userBlades.team',["users"=>$users],['user.adminHome',["users"=>$users]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
  
        //User::create($request->all());
         User::create([
            'firstname' => $request['firstname'],
            'lastname' =>$request['lastname'],
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);
   
        return redirect()->route('users.index')
                        ->with('success','User created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     //* @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::find($id);
        return view('userBlades.profile',compact('user'),["user"=>$user]);
        //dd($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'phone' => 'required',
                'email' => 'required',
         ]);
        $user ->update($request->all());
  
        return redirect()->route('admin-actions.index')
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
        User::find($id)->delete();
  
        return redirect()->route('admin-actions.index')
                        ->with('success','User deleted successfully');
    }

    public function destroyMultiple($id)
    {
        $IDs = [];
        $IDs->request($ids);
        foreach ($IDs as $id) {
            User::find($id)->delete();
        }
       
  
        return redirect()->route('admin-actions.index')
                        ->with('success','Users deleted successfully');
    }
}
