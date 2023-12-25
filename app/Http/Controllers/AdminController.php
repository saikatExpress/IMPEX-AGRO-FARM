<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use App\Models\Branch;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cows = Cow::where('branch_id', session('branch_id'))->count();

        return view('welcome', compact('cows'));
    }

    public function branch()
    {
        if (session('branch_id')) {
            session()->forget('branch_id');
            // Redirect to the branch selection page with a message if needed
            return redirect()->route('branch')->with('success', 'Previous branch selection removed.');
        }

        $branches = Branch::where('status', '1')->get();

        return view('branch.branch', compact('branches'));
    }
}