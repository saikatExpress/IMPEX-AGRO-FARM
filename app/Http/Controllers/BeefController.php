<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cow;
use App\Models\Beef;
use App\Models\BeefSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreBeefRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateBeefRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class BeefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function sellListIndex()
    {
        $sellList = BeefSell::where('branch_id', session('branch_id'))->get();

        return view('beef.sell_list', compact('sellList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cows = Cow::with('branch')->where('branch_id', session('branch_id'))->where('flag', '0')->where('status', '1')->get();

        return view('beef.create_beef', compact('cows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeefRequest $request)
    {
        try {
            DB::beginTransaction();

            $cowIds    = $request->input('cow_id');
            $totalBeef = $request->input('total_beef');

            $beefObj = new Beef;

            $beefObj->branch_id  = session('branch_id');
            $beefObj->cow_id     = implode(',', $cowIds);
            $beefObj->total_beef = $request->input('total_beef');

            $res = $beefObj->save();

            if($res){
                $this->cowUpdateWithIds($cowIds);
                DB::commit();
                return redirect()->back()->with('message', 'Beef Created');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function cowUpdateWithIds($cowIds)
    {
        try {
            DB::beginTransaction();
            $updateData = [
                'flag' => '1'
            ];

            $res = DB::table('cows')
                ->whereIn('id', $cowIds)
                ->update($updateData);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function beefSell()
    {
        $currentDate = Carbon::today();

        // Retrieve records from the 'beefs' table where the 'created_at' field matches the current date
        $beefsForToday = Beef::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->get();

        $totalBeef = $this->beefCount($beefsForToday);

        return view('beef.beef_sell', compact('totalBeef'));
    }

    protected function beefCount($beefsForToday)
    {
        $beefs = array();
        foreach($beefsForToday as $key => $beef){
            $beefs[] = $beef->total_beef;
        }
        return array_sum($beefs);
    }


    public function beefSellCount(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name'     => ['required'],
                'quantity' => ['required'],
                'price'    => ['required'],
                'payment'  => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }

            $beefSellObj = new BeefSell;

            $desiredQuantity = $request->input('quantity');

            $beefSellObj->branch_id    = session('branch_id');
            $beefSellObj->name         = $request->input('name');
            $beefSellObj->quantity     = $desiredQuantity;
            $beefSellObj->price        = $request->input('price');
            $beefSellObj->payment      = $request->input('payment');
            $beefSellObj->due          = $request->input('due');
            $beefSellObj->phone_number = $request->input('phone_number');
            $beefSellObj->created_at   = Carbon::now();

            $res = $beefSellObj->save();

            DB::commit();
            if($res){
                $this->beefUpdate($desiredQuantity);
                return redirect()->back()->with('message', 'Beef Sell successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function sellUpdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $sellId  = $request->input('sell_id');
            $due     = $request->input('due');
            $payment = $request->input('payment');

            $balance = $due - $payment;

            $beefSellObj = new BeefSell;

            $res = $beefSellObj->where('branch_id', session('branch_id'))->where('id', $sellId)->update(['due' => $balance]);

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Payment created successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    protected function beefUpdate($desiredQuantity)
    {
        $currentDate = Carbon::today();
        // Retrieve records from the 'beefs' table where the 'created_at' field matches the current date
        $beefsForToday = Beef::whereDate('created_at', $currentDate)->where('branch_id', session('branch_id'))->get();

            // Get the quantity to be subtracted
        foreach ($beefsForToday as $beef) {
            // Ensure we still need to subtract from this row
            if ($desiredQuantity > 0) {
                $remainingBeef = (int) $beef->total_beef - $desiredQuantity;

                // If the remainingBeef is negative, it means we've consumed all from this row
                if ($remainingBeef < 0) {
                    $desiredQuantity = abs($remainingBeef); // Update the desiredQuantity for the next row
                    $beef->total_beef = 0; // Set the total_beef to 0 for this row
                } else {
                    $beef->total_beef = $remainingBeef; // Update the total_beef for this row
                    $desiredQuantity = 0; // No need to subtract further
                }

                // Update the row in the database
                $beef->save();
            }
        }

        // After processing, you can return the updated records or whatever you wish
        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(Beef $beef)
    {
        $dueList = BeefSell::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('due', '>', 0)->get();

        return view('beef.sell_collect', compact('dueList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beef $beef)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeefRequest $request, Beef $beef)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beef $beef)
    {
        //
    }
}
