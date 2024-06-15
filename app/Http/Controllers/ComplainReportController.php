<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Models\job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComplainReportController extends Controller
{
    public function complainreport(Request $request)
    {
        $value = $request->get('search');
        if ($value != '') {
            $fromdate = session()->get('fromdate');
            $todate = session()->get('todate');
            if ($fromdate != '' && $todate != '') {
                $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
                    ->whereBetween('jobs.created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('jobs.*', 'users.name')->where('name', 'like', "%{$value}%")->orderBy('jobs.id', 'DESC')->get();
            } else {
                $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
                    ->select('jobs.*', 'users.name')
                    ->where('name', 'like', "%{$value}%")
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
            }
        } else {
            $fromdate = session()->get('fromdate');
            $todate = session()->get('todate');

            if ($fromdate != '' && $todate != '') {

                $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
                    ->whereBetween('jobs.created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->select('jobs.*', 'users.name')->orderBy('jobs.id', 'DESC')->get();
            } else {
                $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
                    ->select('jobs.*', 'users.name')
                    ->orderBy('jobs.id', 'DESC')
                    ->get();
            }
        }

        // return $jobs;
        return view('report.complainreport', compact('jobs'));
    }

    public function RepeatComplaint($id)
    {
        //  $job = Job::find($id);
        $complaint = complaint::find($id);
        if ($complaint) {
                $repeatComplaint = new complaint();
                do {
                    $complaintID = mt_rand(100000000000, 999999999999);
                } while (DB::table('complaints')->where('ref_no', $complaintID)->exists());
                $repeatComplaint->ref_no = $complaintID;
                $repeatComplaint->ref_no = $complaint->ref_no;
                $repeatComplaint->_customer_id = $complaint->_customer_id;
                $repeatComplaint->_customer_address_id = $complaint->_customer_address_id;
                $repeatComplaint->creadted_by = $complaint->creadted_by;
                $repeatComplaint->image = $complaint->image;
                $repeatComplaint->item_description = $complaint->item_description;
                $repeatComplaint->remark = $complaint->remark;
                $repeatComplaint->status = $complaint->status;
                $repeatComplaint->priority = $complaint->priority;
                $repeatComplaint->job_category = $complaint->job_category;
                $repeatComplaint->repeat_status = 'Yes';
                $repeatComplaint->created_at = date('Y-m-d H:i:s');
                $repeatComplaint->updated_at = date('Y-m-d H:i:s');
                $repeatComplaint->repeat_id = $complaint->id;
                $repeatComplaint->save();
                return redirect()->route('list.complaint');
        } else {
            return back()->with('success','Record Not Found');
        }

    }

    function complain_filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required_if:to_date,true',
            'to_date' => 'required_if:from_date,true',
        ]);

        session()->put('fromdate', $request->from_date);
        session()->put('todate', $request->to_date);

        return redirect()->route('complainreport');
    }

    public function complain_sample_reset(Request $request)
    {
        session()->forget('fromdate');
        session()->forget('todate');

        session()->pull('fromdate');
        session()->pull('todate');
        return redirect()->route('complainreport');
    }

    public function complaintlist($id)
    {
        $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')
        ->where('jobs.customer_id',$id)
        ->get();
        return view('report.complaintdetail', compact('jobs'));
    }

    public function complaintdetail($id)
    {
        $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name','users.phone_no')
        ->where('jobs.id',$id)
        ->first();
        return view('report.complaintdetail1', compact('jobs'));
    }

    public function customerreport(Request $request)
    {
        $value = $request->get('search');
        if ($value != '') {
            $fromdate = session()->get('fromdate');
            $todate = session()->get('todate');
            if ($fromdate != '' && $todate != '') {
                $jobs = DB::table('users')->where('type', 3)
                    ->whereBetween('created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->orderBy('id', 'DESC')->get();
            } else {
                $jobs = DB::table('users')->where('type', 3)
                    ->where('name', 'like', "%{$value}%")
                    ->orderBy('id', 'DESC')
                    ->get();
            }
        } else {
            $fromdate = session()->get('fromdate');
            $todate = session()->get('todate');

            if ($fromdate != '' && $todate != '') {

                $jobs = DB::table('users')->where('type', 3)
                    ->whereBetween('created_at', [$fromdate . " 00:00:00", $todate . " 23:59:59"])->orderBy('id', 'DESC')->get();
            } else {
                $jobs = DB::table('users')->where('type', 3)
                    ->orderBy('id', 'DESC')
                    ->get();
            }
        }

        return view('report.customerreport', compact('jobs'));
    }

    function customer_filter(Request $request)
    {
        $request->validate([
            'from_date' => 'required_if:to_date,true',
            'to_date' => 'required_if:from_date,true',
        ]);

        session()->put('fromdate', $request->from_date);
        session()->put('todate', $request->to_date);

        return redirect()->route('customerreport');
    }

    public function customer_sample_reset(Request $request)
    {
        session()->forget('fromdate');
        session()->forget('todate');

        session()->pull('fromdate');
        session()->pull('todate');
        return redirect()->route('customerreport');
    }
}
