<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MilkSell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function milkSaleReport()
    {
        return view('report.milk_sale_report');
    }

    public function milkSaleReportShow(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => ['required'],
            'end_date'   => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $milkSellReport = MilkSell::where('branch_id', session('branch_id'))
                    ->whereBetween('sale_date', [$startDate, $endDate])
                    ->get();
        return $milkSellReport;
    }
}
