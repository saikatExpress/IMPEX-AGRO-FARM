<?php

namespace App\Service;

use App\Models\CowVaccine;
use Carbon\Carbon;
use App\Models\Vaccine;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VaccineService
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('login.us');
        }
    }

    public function index()
    {
        $now = Carbon::now();

        $data['vaccines'] = Vaccine::where('status', '1')->get();

        return view('monitor.vaccine.index')->with($data);
    }

    public function store($name, $periodDay, $repeatVaccine, $doseQty, $note)
    {
        try {
            DB::beginTransaction();

            $vaccineObj = new Vaccine();

            $vaccineObj->name           = $name;
            $vaccineObj->slug           = Str::slug($name, '-');
            $vaccineObj->period_days    = $periodDay;
            $vaccineObj->repeat_vaccine = $repeatVaccine;
            $vaccineObj->dose_qty       = $doseQty;
            $vaccineObj->note           = $note;
            $vaccineObj->created_by     = Auth::id();

            $res = $vaccineObj->save();

            DB::commit();
            if($res){
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback($e);
            info($e);
        }
    }

    public function update($vaccineId, $name, $periodDay, $repeatVaccine, $doseQty, $note)
    {
        try {
            DB::beginTransaction();

            $vaccine = Vaccine::find($vaccineId);

            if(!$vaccine){
                return redirect()->back()->with('message', 'Vaccine Not found');
            }

            $data = [
                'name'           => $name,
                'slug'           => Str::slug($name, '-'),
                'period_days'    => $periodDay,
                'repeat_vaccine' => $repeatVaccine,
                'dose_qty'       => $doseQty,
                'note'           => $note,
            ];

            $res = $vaccine->update($data);

            DB::commit();
            if($res){
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback($e);
            info($e);
        }
    }

    public function vaccineStore($shedId, $cowId, $date, $note, $vaccineIds, $remarks, $givenTime)
    {
        try {
            DB::beginTransaction();

            foreach($vaccineIds as $key => $vaccine){
                $cowVaccineObj = new CowVaccine();

                $cowVaccineObj->branch_id = session('branch_id');
                $cowVaccineObj->cow_tag = $cowId;
                $cowVaccineObj->shed_id = $shedId;
                $cowVaccineObj->push_date = $date;
                $cowVaccineObj->note = $note;
                $cowVaccineObj->vaccine_id = $vaccine;
                $cowVaccineObj->remarks = $remarks[$key];
                $cowVaccineObj->given_time = $givenTime[$key];

                DB::commit();
                $cowVaccineObj->save();
            }
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $vaccine = Vaccine::find($id);

            if (!$vaccine) {
                return response()->json(['message' => 'Vaccine found.'], 404);
            }

            $res = $vaccine->delete();

            DB::commit();
            if($res){
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}