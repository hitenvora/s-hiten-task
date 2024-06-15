<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class dashBoardController extends Controller
{
    public function hold_complaines(){
        $hold_complaints = job::where('status', 'Hold')->get();
        return view('job.hold_complaines',compact('hold_complaints'));
    }

    public function pending_complaines()
    {
        $pending_complaines = job::where('status', 'Pending')->get();
        return view('job.pending_complaines',compact('pending_complaines'));
    }
    public function complete_complaines()
    {
        $complete_complaines = job::where('status', 'Complete')->get();
        return view('job.complete_complaines',compact('complete_complaines'));
    } 
}
