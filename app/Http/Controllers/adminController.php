<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Yajra\DataTables\Html\Editor\Fields\Select;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = DB::select('select * from users where is_disabled = ?', [0]);
        //dd($users);


        return view('userBlades.team', ["users" => $users], ['user.adminHome', ["users" => $users]]);
    }

    public function disabledUsers()
    {

        $disabledUsers = DB::select('select * from users where is_disabled=?', [1]);
        return view('userBlades.disabledUsers', ["disabledUsers" => $disabledUsers]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate(['firstname' => ['required', 'string', 'max:255'], 'lastname' => ['required', 'string', 'max:255'], 'username' => ['required', 'string', 'max:255'], 'phone' => ['required', 'numeric', 'min:10'], 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 'password' => ['required', 'alpha_num', 'min:8'],]);

        $q = User::create(['firstname' => $request['firstname'], 'lastname' => $request['lastname'], 'username' => $request['username'], 'email' => $request['email'], 'phone' => $request['phone'], 'password' => Hash::make($request['password']),]);

        if ($q) {
            return redirect()->route('admin-actions.index')->with('success', 'User created successfully.');
        } else {
            return redirect()->route('admin-actions.index')->with('danger', "Oops.. It's us not you. Something went wrong. Please try again.");
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('userBlades.profile', compact('user'), ["user" => $user]);
    }

    public function showPasswordPage($id){
        $user = User::find($id);
        return view('userBlades.updatePassword', compact('user'), ["user" => $user]);
    }


    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $oldPass = $request['old-password'];
        $newPass = $request['password'];

        if (Auth::user()->is_admin == 1) {

            #Match The Old Password
            if (!Hash::check($oldPass,$user->password)) {

                return redirect()->route('admin-actions.index')->with('danger', 'Old Password is incorrect');
            }

            $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',

            ]);

            if ($validator->fails()) {
                return redirect()->route('updateUserPassword',$id)
                    ->withErrors($validator);
            }

            #Update the new Password
            $update = User::whereId($id)->update(['password' => Hash::make($newPass)]);

            if ($update) {

                return redirect()->route('admin-actions.index')->with('success', 'Password updated successfully');
            } else {

                return redirect()->route('admin-actions.index')->with('danger', 'Password Not updated successfully');
            }

        }
        else {
            #Match The Old Password
            if (!Hash::check($oldPass, $user->password)) {

                return redirect()->route('admin-actions.show', $id)->with('danger', 'Old password is incorrect');
            }

                $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'password' => 'required|min:8|confirmed',

                ]);

                if ($validator->fails()) {
                    return redirect()->route('updateUserPassword',$id)
                        ->withErrors($validator);
                }

//                #Update the new Password
                $update = User::whereId(Auth::user()->id)->update(['password' => Hash::make($newPass)]);

                if ($update) {
                    auth::logout();
//                    if (Auth::check()) {
                        return redirect()->route('login')->with('success', 'Your password has been changed.Log in with new password');

                }
                else {
                    return redirect()->route('admin-actions.show', Auth::user()->id)->with('danger', 'Password Not updated successfully');

                }



        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {

        $user = User::find($id);
        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->username = request('username');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->save();
        $request->validate(['firstname' => 'required', 'string', 'max:255', 'lastname' => 'required', 'string', 'max:255', 'username' => 'required', 'string', 'max:255', 'phone' => 'required', 'numeric', 'min:10', 'email' => 'required', 'string', 'email', 'max:255', 'unique:users',]);
        $user->update($request->all());

        if (Auth::user()->is_admin == 1) {

            return redirect()->route('admin-actions.index')->with('success', 'Profile updated successfully');
        }
        return redirect()->route('admin-actions.show', Auth::user()->id)->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        //User::find($id)->delete();
        $disabledUser = User::find($id);
        if ($disabledUser->is_disabled == 0) {

            $disabledUser->is_disabled = '1';
            $disabledUser->save();
            return redirect()->route('admin-actions.index')->with('success', 'User disabled successfully');

        } else {

            $disabledUser->is_disabled = '0';
            $disabledUser->save();
            return redirect()->route('admin-actions.index')->with('success', 'User enabled successfully');
        }


    }

    public function enableUser($id)
    {
        //User::find($id)->delete();
        $enableUser = User::find($id);
        if ($enableUser) {
            $enableUser->is_disabled = '0';
            $enableUser->save();
        }


        return redirect()->route('admin-actions.index')->with('success', 'User enabled successfully');
    }

    //changing password functionality


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if ($user && isset($_GET['change'])) {

            $old_password = $_GET['old_password'];
            if (Hash::check($old_password, $user->password)) {
                $new_password = $_GET['password'];
                $confirm_password = $_GET['confirm_password'];

                if ($new_password == $confirm_password) {
                    $user->password = request('password');
                    $user->save();
                    echo("i reach here");
                    $request->validate((array)$request, ['password' => ['required', 'alpha_num', 'min:8', 'confirmed'],]);


                    $user->update(['password' => Hash::make($request['password'])]);
                    if ($user) {
                        echo("i reach here updated");
                    }

                } else {
                    echo("paswords do not match");
                }

                //  return redirect()->route('admin.home')
                //                  ->with('success','password changed successfully');
            } else {
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
