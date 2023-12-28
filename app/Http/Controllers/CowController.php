<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Buyer;
use App\Models\CowSell;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Account;
use App\Models\Category;
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
        $categories = Category::all();
        $cows        = Cow::with('branch:id,branch_name', 'category:id,name')->where('branch_id', session('branch_id'))->latest()->get();

        return view('cow.cow_list', compact('cows', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        $expenseType = Expense::all();

        return view('cow.create_cow', compact('categories', 'expenseType'));
    }

    public function sellCreate()
    {
        $cows   = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('flag', '0')->get();
        $buyers = Buyer::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('status', '1')->latest()->get();

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
            $cowId      = $request->input('cow_id');
            $price      = $request->input('price');
            $payment    = $request->input('payment');
            $buyerId    = $request->input('buyer_id');
            $due        = $request->input('due');

            $cowSellObj->branch_id   = session('branch_id');
            $cowSellObj->cow_id      = $cowId;
            $cowSellObj->buyer_id    = $buyerId;
            $cowSellObj->price       = $price;
            $cowSellObj->payment     = $payment;
            $cowSellObj->due         = $due;
            $cowSellObj->sell_date   = $request->input('sell_date');
            $cowSellObj->description = $request->input('description');
            $cowSellObj->status      = $request->input('status');
            $cowSellObj->created_at  = Carbon::now();

            $res = $cowSellObj->save();

            DB::commit();
            if($res){
                $lastInsertedId    = $cowSellObj->id;
                $this->incomeBalanceUpdate($lastInsertedId, $payment, $due);
                if($due >= 0){
                    $balanceServiceObj = new BalanceService;

                    $this->cowFlagUpdate($cowId);
                    $balanceServiceObj->balanceUpdate($buyerId, $due);
                }
                return redirect()->back()->with('message', 'Sell Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function cowFlagUpdate($id)
    {
        $cow = Cow::find($id);
        if($cow){
            $cow->update(['flag' => '1']);
        }
    }

    public function incomeBalanceUpdate($lastInsertedId, $payment, $due)
    {
        $incomeObj = new Income;

        $incomeObj->branch_id = session('branch_id');
        $incomeObj->sell_id   = $lastInsertedId;
        $incomeObj->amount    = $payment;
        $incomeObj->due       = $due;

        $res = $incomeObj->save();

        if($res){
            return true;
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

            $price     = $request->input('price');
            $transport = $request->input('transport');
            $hasil     = $request->input('hasil');

            $total = $price + $transport + $hasil;

            $cowObj->branch_id   = session('branch_id');
            $cowObj->price       = $price;
            $cowObj->category_id = $request->input('category_id');
            $cowObj->tag         = $request->input('tag');
            $cowObj->caste       = $request->input('caste');
            $cowObj->weight      = $request->input('weight');
            $cowObj->transport   = $transport;
            $cowObj->hasil       = $hasil;
            $cowObj->total       = $total;
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
                $balanceServiceObj = new BalanceService;

                $lastInsertedId = $cowObj->id;
                $expenseType    = $request->input('expense_type');

                $result = $balanceServiceObj->accountDecrement($lastInsertedId,$expenseType, $total);
                if($result == true){
                    return redirect()->back()->with('message', 'Cow Created successfully');
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function sellCollect()
    {
        $dueCollect = CowSell::with('branch:id,branch_name', 'buyer:id,name', 'cow:id,tag')->where('branch_id', session('branch_id'))->where('due', '>', 0)->get();

        return view('cow.sell_collect', compact('dueCollect'));
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

            $cowId     = $request->input('cow_id');
            $price     = $request->input('price');
            $transport = $request->input('transport');
            $hasil     = $request->input('hasil');
            $total     = $price + $transport + $hasil;

            $validatedData = [
                'price'       => $price,
                'category_id' => $request->input('category_id'),
                'tag'         => $request->input('tag'),
                'caste'       => $request->input('caste'),
                'weight'      => $request->input('weight'),
                'transport'   => $transport,
                'hasil'       => $hasil,
                'total'       => $total,
                'color'       => $request->input('color'),
                'buy_date'    => $request->input('buy_date'),
                'age'         => $request->input('age'),
                'description' => $request->input('description'),
            ];

            $cow = Cow::find($cowId);
            if (!$cow) {
                return redirect()->back()->with('message', 'Cow not found');
            }

            $res = $cow->update($validatedData);

            DB::commit();
            if ($res) {
                $this->accountUpdate($cowId,$total);
                return redirect()->back()->with('message', 'Update successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function accountUpdate($cowId, $total)
    {
        $accountObj = new Account;

        $account = $accountObj->where('buy_id', $cowId)->where('branch_id', session('branch_id'))->first();

        if($account){
            $res = $account->update(['amount' => $total]);
            if($res){
                return true;
            }
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