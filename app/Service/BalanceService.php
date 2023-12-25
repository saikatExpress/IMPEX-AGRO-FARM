<?php

namespace App\Service;

use App\Models\Buyer;

class BalanceService
{
    public function balanceUpdate($id, $due)
    {
        $buyer = Buyer::where('branch_id', session('branch_id'))->where('id', $id)->first();

        if(!$buyer){
            return false;
        }

        if($buyer){
            $balance = $buyer->balance;
            $newBalance = $balance + $due;

            $res = DB::table('buyers')->where('branch_id', session('branch_id'))->where('id', $id)->update(['due' => $newBalance]);
            if($res){
                return true;
            }
        }

        return false;
    }
}