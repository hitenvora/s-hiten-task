<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Technician;
use App\Models\job;
use Carbon\Carbon;

class TechnichianReportController extends Controller
{
    //
    public function technichianreport(Request $request)
    {

        if (session()->get('fromdate') != '' && session()->get('todate')) {
            $totalTechnician = Technician::whereBetween('created_at', [session()->get('fromdate') . " 00:00:00", session()->get('todate') . " 23:59:59"])->count();
            $checkinCounts = DB::table('attendances')->select('technician_id', DB::raw('COUNT(*) as checkin_count'))->whereDate('check_time', Carbon::today()->toDateString())->where('check_status', 'In')->whereBetween('created_at', [session()->get('fromdate') . " 00:00:00", session()->get('todate') . " 23:59:59"])->groupBy('technician_id')->get();
            $totalAbsent = DB::table('technicians as t')->select('t.id', DB::raw('COUNT(a.technician_id) as absent_count'))->leftJoin('attendances as a', function ($join) {
                $join->on('t.id', '=', 'a.technician_id')->whereDate('a.check_time', Carbon::today()->toDateString())->where('a.check_status','In');
            })->whereNull('a.technician_id')->whereBetween('t.created_at', [session()->get('fromdate') . " 00:00:00", session()->get('todate') . " 23:59:59"])->groupBy('t.id')->get();
        } else {
            $totalTechnician = Technician::count();
            $checkinCounts = DB::table('attendances')->select('technician_id', DB::raw('COUNT(*) as checkin_count'))->whereDate('check_time', Carbon::today()->toDateString())->where('check_status', 'In')->groupBy('technician_id')->get();
            $totalAbsent = DB::table('technicians as t')->select('t.id', DB::raw('COUNT(a.technician_id) as absent_count'))->leftJoin('attendances as a', function ($join) {
                $join->on('t.id', '=', 'a.technician_id')->whereDate('a.check_time', Carbon::today()->toDateString())->where('a.check_status','In');
            })->whereNull('a.technician_id')->groupBy('t.id')->get();
        }
        


        $totalAbsent = count($totalAbsent);
        $checkinCounts = count($checkinCounts);

        $fromdate = session()->get('fromdate');
        $todate = session()->get('todate');

        $date =  Carbon::today()->toDateString();
       
        $value = $request->get('search');
        if ($value != '') {
            if ($fromdate != '' && $todate != '') {
                $complaints = DB::table('technicians')->select('id','mobile_no', 'name','created_at')->where('name', 'like', "%{$value}%")->whereBetween('created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->orderBy('technicians.id', 'DESC')->get();
            } else {
                $complaints = DB::table('technicians')->select('id','mobile_no', 'name','created_at')->where('name', 'like', "%{$value}%")->orderBy('technicians.id', 'DESC')->get();
            }
            
        } else {
            if ($fromdate != '' && $todate != '') {
                $complaints = DB::table('technicians')->select('id','mobile_no', 'name','created_at')->whereBetween('created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->orderBy('technicians.id', 'DESC')->get();
            } else {
                $complaints = DB::table('technicians')->select('id','mobile_no', 'name','created_at')->orderBy('technicians.id', 'DESC')->get();
            }
            
        }
        
        $getTechnician = Technician::paginate();
        return view('report.technicianreport',compact('totalTechnician','totalAbsent','checkinCounts','complaints','date','getTechnician'));
        
    }

    function technician_filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required_if:to_date,true',
            'to_date' => 'required_if:from_date,true',
        ]);
        
        session()->put('fromdate',$request->from_date);
        session()->put('todate',$request->to_date);
        
        return redirect()->route('technicianreport');
    }
    
    public function texhnician_sample_reset(Request $request)
    {
        session()->forget('fromdate');
        session()->forget('todate');
        
        session()->pull('fromdate');
        session()->pull('todate');
        return redirect()->route('technicianreport');
    }
   
}
