<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('welcome');
    }

    public function branch()
    {
        $branches = Branch::where('status', '1')->get();

        return view('branch.branch', compact('branches'));
    }
}