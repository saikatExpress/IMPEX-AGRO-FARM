<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.user_list', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create_user', compact('roles'));
    }
}