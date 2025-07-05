<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('login/signin');
    }

    public function check(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        // echo '<pre>';
        // print_r($request->all());

        //creating user object from model
        // $user = new User();
        // //making variables from request data for model.
        // $name = explode('@', $request['email'])[0];
        // $user->name = $name;
        // $user->email = $request['email'];
        // //md5 used to encrypt password
        // $user->password = md5($request['password']);
        // $user->save();
        session_start();
        $user = User::all();
        if (!empty($user)) {
            $user = $user->toArray();
            $pass = md5($request['password']);
            $email = $request['email'];
            for ($data = 0; $data < count($user); $data++) {
                if ($email == $user[$data]['email'] && $pass == $user[$data]['password']) {
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $user[$data]['name'];
                    $_SESSION['role'] = $user[$data]['role'];
                    return redirect('/user/admin');
                }
            }
            $msg = 'Incorrect credentials';
            return redirect('/login/signin')->with('msg', $msg);
        }
    }


    public function view_admin_production()
    {
        return view('admin/admin_production');
    }

    public function user_signout()
    {
        session_destroy();
        return redirect('/');
    }
}
