<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use App\Models\Semen;
use App\Models\Pregnancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorePregnancyRequest;
use App\Http\Requests\UpdatePregnancyRequest;

class PregnancyController extends Controller
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
        $readpreg=Pregnancy::all();
        $read = Cow::all();
        $reads =[];
        $cows = Cow::with('branch:id,branch_name')->where('branch_id', session('branch_id'))->where('category_id', 1)->where('flag', '0')->get();
        $semens = Semen::where('status', '1')->get();

        return view('preganancy.create_pregnancy', compact('cows', 'semens','read','reads','readpreg'));
    }

    public function zone_search(Request $request)
    {
        // Fetch all zones
        $readpreg=Pregnancy::all();
        $reads = Cow::all();
        $read = Cow::all();
        $cows=[];
        
        // Check if there's a search query
        if ($request->has('search')) {
            $search = $request->get('search');
            // Perform search
            $reads = Cow::where('tag', 'like', '%' . $search . '%')
                         ->get();
        }
        
        // Pass zones data to the view
        return view('preganancy.create_pregnancy', compact('read','reads','cows','readpreg'));
        //return redirect()->back()->with('reads');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $data1 = $request->validate([
            'cow_id' => 'required',
            'branch_id' => 'nullable',
            'semen_id' => 'nullable',
            'due' => 'nullable',
            'status' => 'nullable',
            
            'pregnancy_type' => 'required',
            'push_date' => 'required',
            'start_date' => 'required',
            'semen_cost'=>'required',
            'other_cost' => 'required',

        ]);


         $newt = Pregnancy::create($data1);

        //DB::table('employeesdata')->insert($data1);

        if($newt){
            return redirect()->back();
        }
        
        







        // try {
        //     DB::beginTransaction();

        //     $pregnancyObj = new Pregnancy;

        //     $pregnancyObj->branch_id      = Session('branch_id');
        //     $pregnancyObj->pregnancy_type = $request->input('pregnancy_type');
        //     $pregnancyObj->semen_id       = $request->input('semen_id');
        //     $pregnancyObj->push_date      = $request->input('push_date');
        //     $pregnancyObj->start_date     = $request->input('start_date');
        //     $pregnancyObj->semen_cost     = $request->input('semen_cost');
        //     $pregnancyObj->other_cost     = $request->input('other_cost');
        //     $pregnancyObj->due            = $request->input('semen_cost') + $request->input('other_cost');
        //     $pregnancyObj->due            = '1';

        //     $res = $pregnancyObj->save();
        //     if($res){
        //         return redirect()->back()->with('message', 'Pregnancy Start');
        //     }
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     info($e);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pregnancy $pregnancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pregnancy $pregnancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePregnancyRequest $request, Pregnancy $pregnancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pregnancy $pregnancy)
    {
        //
    }
}
