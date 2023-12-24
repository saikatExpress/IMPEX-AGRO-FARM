<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create_user', compact('roles'));
    }
}