<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use app\Models\sales\Igsalesconf;
use app\Models\sales\TblConfirmeddeals;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function salesCost(){

        $igSales = Igsalesconf::all();

        foreach($igSales as $sale){
            $deal = TblConfirmeddeals::where('ReferenceNumber', $sale->ReferenceNumber)->get();
            dd($deal, $sale);
        }

        return ('done');








    }
}
