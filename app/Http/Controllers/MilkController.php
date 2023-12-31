<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Milk;
use App\Models\MilkSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreMilkRequest;
use App\Http\Requests\UpdateMilkRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class MilkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cows = Cow::where('branch_id', session('branch_id'))->where('category_id', 1)->get();

        return view('milk.create_milk', compact('cows'));
    }

    public function milkSellCreate()
    {
        $currentDate = Carbon::today();

        // Retrieve records from the 'beefs' table where the 'created_at' field matches the current date
        // $milksForToday = Milk::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->sum('quantity');

        return view('milk.sell_milk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMilkRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $milkObj = new Milk;

            $milkObj->branch_id = session('branch_id');
            $milkObj->cow_id    = $id;
            $milkObj->milk_date = $request->input('date');
            $milkObj->quantity  = $request->input('quantity');

            $res = $milkObj->save();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Milk Store']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function milkSellStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => ['required'],
            'sale_date'    => ['required'],
            'quantity'     => ['required'],
            'price'        => ['required'],
            'payment'      => ['required'],
            'due'          => ['required'],
            'phone_number' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $milkSellObj = new MilkSell;

        $milkSellObj->branch_id    = session('branch_id');
        $milkSellObj->name         = $request->input('name');
        $milkSellObj->sale_date    = $request->input('sale_date');
        $milkSellObj->quantity     = $request->input('quantity');
        $milkSellObj->price        = $request->input('price');
        $milkSellObj->payment      = $request->input('payment');
        $milkSellObj->due          = $request->input('due');
        $milkSellObj->phone_number = $request->input('phone_number');

        $res = $milkSellObj->save();

        if($res){
            return redirect()->back()->with('message', 'Milk Sell Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Milk $milk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milk $milk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilkRequest $request, Milk $milk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milk $milk)
    {
        //
    }
}
