<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Service\BalanceService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreCowRequest;
use App\Http\Requests\UpdateCowRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cows = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->get();

        return view('cow.cow_list', compact('cows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cow.create_cow');
    }

    public function sellCreate()
    {
        $cows   = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', '0')->get();
        $buyers = Buyer::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('status', '1')->get();

        return view('cow.sell_cow', compact('cows', 'buyers'));
    }

    public function sellStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'cow_id'    => ['required'],
                'buyer_id'  => ['required'],
                'price'     => ['required'],
                'payment'   => ['required'],
                'sell_date' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $cowSellObj = new CowSell;
            $price      = $request->input('price');
            $payment    = $request->input('payment');
            $buyerId    = $request->input('buyer_id');

            $due = $price - $payment;

            $cowSellObj->branch_id   = session('branch_id');
            $cowSellObj->cow_id      = $request->input('cow_id');
            $cowSellObj->buyer_id    = $buyerId;
            $cowSellObj->price       = $price;
            $cowSellObj->payment     = $payment;
            $cowSellObj->due         = ($due > 0) ? $due : 0;
            $cowSellObj->sell_date   = $request->input('sell_date');
            $cowSellObj->description = $request->input('description');
            $cowSellObj->status      = $request->input('status');
            $cowSellObj->created_at  = Carbon::now();

            $res = $cowSellObj->save();

            DB::commit();
            if($res){
                if($due > 0){
                    $balanceServiceObj = new BalanceService;

                    $balanceServiceObj->balanceUpdate($buyerId, $due);
                }
                return redirect()->back()->with('message', 'Sell Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCowRequest $request)
    {
        try {
            DB::beginTransaction();

            $cowObj = new Cow;

            $cowObj->branch_id   = session('branch_id');
            $cowObj->price       = $request->input('price');
            $cowObj->type        = $request->input('type');
            $cowObj->tag         = $request->input('tag');
            $cowObj->caste       = $request->input('caste');
            $cowObj->weight      = $request->input('weight');
            $cowObj->transport   = $request->input('transport');
            $cowObj->hasil       = $request->input('hasil');
            $cowObj->color       = $request->input('color');
            $cowObj->buy_date    = $request->input('buy_date');
            $cowObj->age         = $request->input('age');
            $cowObj->description = $request->input('description');
            $cowObj->status      = '1';
            $cowObj->flag        = '0';
            $cowObj->created_at  = Carbon::now();

            $res = $cowObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Cow Created successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cow $cow)
    {
        //
    }

    public function cowInfo($id)
    {
        $cow = Cow::where('branch_id', session('branch_id'))->where('id', $id)->first();

        return response()->json($cow);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cow $cow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCowRequest $request)
    {
        try {
            DB::beginTransaction();

            $cowId = $request->input('cow_id');
            $validatedData = $request->validated();

            $cow = Cow::find($cowId);
            if (!$cow) {
                return redirect()->back()->with('message', 'Cow not found');
            }

            $res = $cow->update($validatedData);

            DB::commit();
            if ($res) {
                return redirect()->back()->with('message', 'Update successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cow $cow, $id)
    {
        try {
            DB::beginTransaction();

            $cow = Cow::find($id);

            if(!$cow){
                return response()->json(['message' => 'Cow not Found.']);
            }

            $res = $cow->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Cow deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
