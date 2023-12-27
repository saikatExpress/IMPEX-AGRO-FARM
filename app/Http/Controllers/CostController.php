<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cost;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreCostRequest;
use App\Http\Requests\UpdateCostRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs = Cost::with('branch:id,branch_name', 'expenseTypes:id,name')->where('branch_id', session('branch_id'))->get();

        return view('cost.cost_list', compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenses = Expense::all();

        return view('cost.create_cost', compact('expenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCostRequest $request)
    {
        try {
            DB::beginTransaction();

            $costObj = new Cost;

            $costObj->branch_id    = session('branch_id');
            $costObj->name         = $request->input('name');
            $costObj->expense_type = $request->input('expense_type');
            $costObj->cost_amount  = $request->input('cost_amount');
            $costObj->cost_date    = $request->input('cost_date');
            $costObj->description  = $request->input('description');
            $costObj->status       = '1';
            $costObj->created_at   = Carbon::now();

            $res = $costObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Save Successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cost $cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCostRequest $request, Cost $cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cost $cost)
    {
        //
    }
}
