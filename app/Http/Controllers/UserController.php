<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::get();
        // return $datas;
        return view('admin.users.index', compact('datas'));
    }

    public function create()
    {
        $roles = DB::table('roles')
            ->where('name', '!=', 'Administrator')
            ->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        // return $request->all();
        $validation  = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);


        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);


        Alert::success('Success', 'User created successfully');

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            Alert::error('Error', 'User not found');
            return redirect()->route('users.index');
        }
        $roles = DB::table('roles')
            ->where('name', '!=', 'Administrator')
            ->get();

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            Alert::error('Error', 'User not found');
            return redirect()->route('users.index');
        }

        $validation  = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? $request->password : $user->password,
            'role_id' => $request->role_id,
        ]);

        Alert::success('Success', 'User updated successfully');

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            Alert::error('Error', 'User not found');
            return redirect()->route('user.index');
        }

        $user->delete();

        Alert::success('Success', 'User deleted successfully');

        return redirect()->route('users.index');
    }
}
