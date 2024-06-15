<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Attendance extends Controller
{
    //
    function get_in_tech(Request $request)
    {
        $toalCheckIn=DB::table('attendances')
                        ->join('technicians','attendances.technician_id','=','technicians.id')
                        ->select('attendances.check_time','technicians.name')
                        ->where('check_time', 'LIKE', '%'.date('Y-m-d').'%')
                        ->get();

        return view('technician.list_in_tech' ,compact('toalCheckIn'));
    }
}
