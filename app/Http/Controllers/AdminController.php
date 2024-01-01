<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Cost;
use App\Models\Milk;
use App\Models\Staff;
use App\Models\Beef;
use App\Models\Income;
use App\Models\Branch;
use App\Models\Account;
use App\Models\BeefSell;
use App\Models\MilkSell;
use App\Models\StaffSalary;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cows          = Cow::where('branch_id', session('branch_id'))->where('status', '1')->where('flag', '0')->count();
        $currentDate   = Carbon::today();
        $beefsForToday = Beef::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->get();
        $totalBeef     = $this->beefCount($beefsForToday);
        $branchName    = Branch::where('id', session('branch_id'))->first();
        $permanetCost  = Cost::where('branch_id', session('branch_id'))->where('expense_type', 2)->sum('cost_amount');
        $farm1Cost     = Cost::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('cost_amount');
        $staffs        = Staff::where('branch_id', session('branch_id'))->where('status', 1)->count();
        $farmCosts     = Account::where('branch_id', session('branch_id'))->where('expense_type', 1)->sum('amount');

        $totalCost = $permanetCost + $farm1Cost + $farmCosts;

        $incomes  = Income::where('branch_id', session('branch_id'))->sum('amount');
        $dues     = Income::where('branch_id', session('branch_id'))->sum('due');
        $beefDues = BeefSell::where('branch_id', session('branch_id'))->sum('due');

        $beefSellAmount    = BeefSell::where('branch_id', session('branch_id'))->sum('payment');
        $todayIncome       = BeefSell::where('branch_id', session('branch_id'))->whereDate('created_at', $currentDate)->sum('payment');
        $staffSalaryAmount = StaffSalary::where('branch_id', session('branch_id'))->sum('amount');
        $totalMilk = Milk::where('branch_id', session('branch_id'))->sum('quantity');
        $todayMilkCount = Milk::where('branch_id', session('branch_id'))->whereDate('milk_date', $currentDate)->sum('quantity');
        $milkIncome = MilkSell::where('branch_id', session('branch_id'))->sum('payment');
        $milkIdue = MilkSell::where('branch_id', session('branch_id'))->sum('due');

        return view('welcome', compact('dues','cows','milkIncome', 'milkIdue','staffSalaryAmount', 'todayMilkCount', 'totalMilk', 'beefDues','todayIncome', 'beefSellAmount', 'totalBeef', 'branchName', 'permanetCost', 'staffs', 'farmCosts','incomes', 'totalCost', 'farm1Cost'));
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