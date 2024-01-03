<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        return view('user.user_list', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create_user', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'         => ['required','max:255'],
                'email'        => ['required','email', 'unique:users,email'],
                'phone_number' => ['required'],
                'password'     => ['required'],
                'status'       => ['required'],
                'role'         => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::create([
                'name'         => Str::title($request->input('name')),
                'email'        => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'password'     => $request->input('password'),
                'status'       => $request->input('status'),
                'role'         => $request->input('role'),
            ]);

            $user->syncRoles($request->role);
            DB::commit();
            return back()->with('message', 'User & Role created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function userProfile()
    {
        return view('user.user_profile');
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'         => ['required','max:255'],
                'role'         => ['required'],
                'status'       => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::find(auth()->user()->id);

            if($user){
                $user->update([
                    'name'         => Str::title($request->input('name')),
                    'role'         => $request->input('role'),
                    'status'       => $request->input('status'),
                ]);

                $user->syncRoles($request->role);
                DB::commit();
                return back()->with('message', 'User & Role update successfully');

            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}