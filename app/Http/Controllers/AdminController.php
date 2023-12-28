<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Cost;
use App\Models\Staff;
use App\Models\Beef;
use App\Models\Branch;
use App\Models\Account;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cows = Cow::where('branch_id', session('branch_id'))->where('status', '1')->where('flag', '0')->count();

        $currentDate = Carbon::today();

        // Retrieve records from the 'beefs' table where the 'created_at' field matches the current date
        $beefsForToday = Beef::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->get();

        $totalBeef = $this->beefCount($beefsForToday);

        $branchName = Branch::where('id', session('branch_id'))->first();

        $permanetCost = Cost::where('branch_id', session('branch_id'))->where('expense_type', 2)->sum('cost_amount');
        $farm1Cost = Cost::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('cost_amount');

        $staffs = Staff::where('branch_id', session('branch_id'))->where('status', 1)->count();

        $farmCosts = Account::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('amount');

        $totalCost = $permanetCost + $farm1Cost + $farmCosts;

        return view('welcome', compact('cows', 'totalBeef', 'branchName', 'permanetCost', 'staffs', 'farmCosts', 'totalCost', 'farm1Cost'));
    }

    protected function beefCount($beefsForToday)
    {
        $beefs = array();
        foreach($beefsForToday as $key => $beef){
            $beefs[] = $beef->total_beef;
        }
        return array_sum($beefs);
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