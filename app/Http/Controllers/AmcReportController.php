<?php

namespace App\Http\Controllers;

use App\Models\AMC;
use App\Models\CustomerDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmcReportController extends Controller
{
    //
    public function amcreport(Request $request)
    {
        $fromdate = session()->get('fromdate');
        $todate = session()->get('todate');

        $value = $request->get('search');
        if ($value != '') {
            if ($fromdate != '' && $todate != '') {
                $amcs = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('name', 'like', "%{$value}%")
                    ->orderBy('id', 'DESC')->get();
                $amcsrate = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('name', 'like', "%{$value}%")
                    ->orderBy('id', 'DESC')->sum('amcs.contract_amount');
                $withspare = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('amc_type','With Spare')->count();
                $withoutspare = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('amc_type','With Spare')->count();
            } else {
                $amcs = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('name', 'like', "%{$value}%")
                    ->orderBy('id', 'DESC')
                    ->get();
                $amcsrate = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('name', 'like', "%{$value}%")
                    ->orderBy('id', 'DESC')
                    ->sum('amcs.contract_amount');
                $withspare = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('amc_type','With Spare')
                    ->count();
                $withoutspare = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('amc_type','Without Spare')
                    ->count();
            }
        } else {
            if ($fromdate != '' && $todate != '') {
                $amcs = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')
                    ->orderBy('id', 'DESC')->sum('amcs.contract_amount');
                $amcsrate = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')
                    ->orderBy('id', 'DESC')->get();
                $withspare = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('amc_type','With Spare')->count();
                $withoutspare = DB::table('amcs')->join('users', 'amcs._user_id', '=', 'users.id')->join('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
                    ->whereBetween('amc_visit.visit_date', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('users.name', 'amcs.*')->where('amc_type','With Spare')->count();
            } else {
                $amcs = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->orderBy('id', 'DESC')
                    ->get();
                $amcsrate = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->orderBy('id', 'DESC')
                    ->sum('amcs.contract_amount');
                $withspare = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('amc_type','With Spare')
                    ->count();
                $withoutspare = DB::table('amcs')
                    ->join('users', 'amcs._user_id', '=', 'users.id')
                    ->select('users.name', 'amcs.*')
                    ->where('amc_type','Without Spare')
                    ->count();
            }
        }


        return view('report.amcreport', compact('amcs','withspare','withoutspare','amcsrate'));
    }

    function amc_filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required_if:to_date,true',
            'to_date' => 'required_if:from_date,true',
        ]);

        session()->put('fromdate', $request->from_date);
        session()->put('todate', $request->to_date);

        return redirect()->route('amcreport');
    }

    public function amc_sample_reset(Request $request)
    {
        session()->forget('fromdate');
        session()->forget('todate');

        session()->pull('fromdate');
        session()->pull('todate');
        return redirect()->route('amcreport');
    }

    public function ViewReport($id)
    {
        //  DB::table('amcs')->where('id',$id)->first();
        $amc =  DB::table('amcs')
        ->join('users', 'amcs._user_id', '=', 'users.id')
        ->join('customer_details', 'amcs._customer_details_id', '=', 'customer_details.id')
        ->select('users.name','users.phone_no', 'amcs.*','customer_details.location_type','customer_details.address')->where('amcs.id',$id)->first();

         $visits = DB::table('amc_visit')->where('_amc_id',$id)->get();
        return view('report.amcdeatail',compact('amc','visits'));
    }
}
