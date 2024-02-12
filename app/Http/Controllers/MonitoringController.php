<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use App\Models\Food;
use App\Models\Shed;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function index()
    {
        $data['cows'] = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', 0)->get();

        return view('monitor.index')->with($data);
    }

    public function vaccineIndex()
    {
        $data['cows'] = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', 0)->get();

        return view('vaccine.index')->with($data);
    }

    public function create()
    {
        $sheds = Shed::with('cows')->where('branch_id', session('branch_id'))->get();
        $foods = Food::all();
        $units = Unit::all();

        return view('monitor.create', compact('sheds', 'foods', 'units'));
    }

    public function vaccineCreate()
    {
        $sheds = Shed::with('cows')->where('branch_id', session('branch_id'))->get();
        $foods = Food::all();
        $units = Unit::all();

        return view('vaccine.create', compact('sheds', 'foods', 'units'));
    }
}