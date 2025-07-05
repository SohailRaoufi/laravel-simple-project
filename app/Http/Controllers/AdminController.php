<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {

        $user = User::all();
        $data = compact('user');
        return view('admin/admin_view_admins')->with($data);
    }

    public function create()
    {
        // session_start();
        if ($_SESSION['role'] == 'owner') {
            $url = url('user/admin/admins/newadmin');
            $title = 'Add New Admin';
            $data = compact('url', 'title');
            return view('admin/admin_new_user')->with($data);
        } else {
            session()->flash('error', 'Only Owner Can Add Admin!!');
            return redirect()->back();
        }
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:user,email|max:255',
                'role' => 'required|in:owner,admin',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]
        );

        //creating user object from model
        $user = new User();
        //making variables from request data for model.
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        //md5 used to encrypt password
        $user->password = md5($request['password']);
        $user->save();


        session()->flash('success', 'Admin Added Successfuly.');
        return redirect('user/admin/admins');
    }

    public function edit($id)
    {

        $ROLES = ['owner', 'admin', 'developer'];


        $admin = User::find($id);
        if (is_null($admin)) {
            return redirect('/user/admin/admins');
        } else {
            if (in_array($admin->role, $ROLES) and $_SESSION['role'] == 'owner') {
                $url = url('user/admin/admins/update') . '/' . $id;
                $title = 'Update Admin';
                $data = compact('admin', 'url', 'title');
                return view('admin/admin_new_user')->with($data);
            } else {
                session()->flash('error', 'Access Denied!');
                return redirect()->back();
            }
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'role' => 'required|in:owner,admin',
            ]
        );

        //creating user object from model
        $user = User::find($id);
        //making variables from request data for model.
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->save();


        session()->flash('success', 'Admin Updated Successfuly.');
        return redirect('user/admin/admins');
    }


    public function delete($id)
    {
        session_start();
        $admin = User::find($id);
        if (!is_null($admin)) {
            if ($_SESSION['role'] == 'owner' && $admin->email != $_SESSION['email']) {
                $admin->delete();
                session()->flash('success', 'Admin deleted successfully.');
            } else if ($_SESSION['email'] == $admin->email && $admin->role != 'owner') {
                $admin->delete();
                session_destroy();
                return redirect('/');
            } else {
                session()->flash('error', 'Access Denied!');
                return redirect()->back();
            }
        }

        return redirect('/user/admin/admins');
    }
}
