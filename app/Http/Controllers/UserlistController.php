<?php

namespace App\Http\Controllers;

use App\Models\Userlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isNull;

class UserlistController extends Controller
{
    //

    function Index()
    {
        $data = Userlist::all();
        return view("user/users")->with('data', $data);
    }
    function UserAdd()
    {
        $heading = "Create User";
        $url = "user-add";
        // $data = [];
        return view("user/user-add")->with(compact('heading', 'url'));
    }
    function UserAddRecord(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:userlist',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $Userlist = new Userlist;
        $Userlist->name = $request->name;
        $Userlist->email = $request->email;
        $Userlist->password = md5($request->password);
        $Userlist->save();
        return back()->with('success', 'Item created successfully!');
    }

    function UserUpdate($id)
    {
        $heading = "Update User";
        $url = "user-edit";
        $data = Userlist::find($id);
        if (is_null($data)) {
            return Redirect('users');
        } else {
            return view("user/user-add")->with(compact('heading', 'url', 'data'));
        }
    }
    function UserUpdateRecord(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => '',
            'password_confirm' => 'same:password',
        ]);

        $Userlist = Userlist::find($request->id);
        $Userlist->name = $request->name;
        $Userlist->password = isset($request->password) ? md5($request->password) : $Userlist->password;
        $Userlist->save();
        // echo "<pre>";
        // print_r( $request->name);
        // echo "</pre>";
        // die;
        return back()->with('success', 'Item update successfully!');
    }

    function UserDelete($id)
    {
        $data = Userlist::find($id);

        if (is_null($data)) {
            return view("users");
        } else {
            $data->delete();
            return Redirect('users')->with('success', 'Item Delete successfully!');;
        }
    }
}
