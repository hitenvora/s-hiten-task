<?php

namespace App\Http\Controllers;

use App\Models\job;
use App\Models\User;
use App\Models\JobSubCategory;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobController extends Controller
{
    //
    function assigned_job(Request $request)
    {
        $getAssignedJob=job::join('technicians','jobs.technician_id','=','technicians.id')
                            ->join('users','jobs.customer_id','=','users.id')
                            ->select('jobs.*','users.name','technicians.name as Tech_Name')
                            ->get();

        return view('job.assigned_job' , compact('getAssignedJob'));
        // print_r($getAssignedJob);
    }

    public function jobDelete($id)
    {
        // return "working";
        $job = job::find($id);
        $job->delete();
        return redirect()->back();
    }    
    
    function invoice(Request $request)
    {
        $id=$request->id;
        $getJobData=DB::table('jobs')->where('id',$id)->first();
   //     $invoice=[];
        $getClientData=DB::table('users')->where('id',$getJobData->customer_id)->first();
        // print_r($getClientData);
        // exit;
        $total = 0;
        foreach (explode(',', $getJobData->job_subcategory) as $key => $value) {
            $subcategory = JobSubCategory::find($value);
            if ($subcategory) {
                // Match found, set status to 1
                $total += $subcategory->price;
            } else {
                // No match found, set status to 0
            }
        }
        $getJobItem=DB::table('job_serviceitem')->where('job_id',$id)->get();

        return view('invoice.invoice',compact('id','getJobData','getClientData','getJobItem'));
    }

    function job_invoice(Request $request)
    {
        $id=$request->id;
        $getJobData=DB::table('jobs')->where('id',$id)->first();
        $getClientData=DB::table('users')->where('id',$getJobData->customer_id)->first();
        $getJobItem=DB::table('job_serviceitem')->where('job_id',$id)->get();
        return view('invoice.job-invoice',compact('id','getJobData','getClientData','getJobItem'));
    }

    function update_assign_technician(Request $request)
    {

        $data=$request->all();
        // echo "<pre>";
        //  print_r($data);exit;

        $update=DB::table('jobs')->where('id',$data['id'])->update([

            "technician_id"=>$data['technician_id'],
            "status"=>'Assign',
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        if($update)
        {
            $all = 'all';
            return redirect()->route('list.job',$all);
        }
    }
    function assign_technician(Request $request)
    {
        $jobData=job::find($request->id);
        return view('job.assign_job')->with('id',$request->id)->with('job',$jobData);
    }
    
    function job_create_form(Request $request)
    {
        // dd($request->all());
        return view('job.create')->with("Id",$request->Id);
    }
    function list_job(Request $request)
    {
        // $jobData=job::find($request->id);
        // return view('job.view',compact('status','jobData'));
      //
        //   $complete_processing = job::where('status', 'Processing')->get();
        $complete_processing = Job::all();

        return view('job.view',compact('complete_processing'));
    }


    function processing_list_job(Request $request)
    {
        
          $complete_processing = job::where('status', 'Processing')->get();
        

        return view('job.Processing', compact('complete_processing'));
    }


     

    function assign_list_job(Request $request)
    {

        $assign_list_job = job::where('status', 'Assign')->get();
        return view('job.list_assign_job', compact('assign_list_job'));
    }


    function pending_list_job(Request $request)
    {

        $pending_list_job = job::where('status', 'Pending')->get();
        return view('job.list_pending_job', compact('pending_list_job'));
    }





    function show_job($id)
    {
    //   return  $job = job::findOrFail($id);
      try {
        // $job = job::where('id', $request->job_id)
        //     ->where('technician_id', Auth::guard('api')->user()->id)
        //     ->first();

        $job = Job::with('helpers')->where('id', $id)->first();

        // Modify job details as needed
        $job->product_image = $job->product_image ? asset('product_image/' . $job->product_image) : 'N/A';
        $job->job_end_time = $job->job_end_time ?? "";
        $job->job_completion_at = $job->job_completion_at ?? "N/A";
        $job->product_model_details = $job->product_model_details ?? "";
        $job->city = $job->city ?? "N/A";
        $job->postal_code = $job->postal_code ?? "N/A";
        $job->deleted_at = $job->deleted_at ?? "N/A";
        $job->estimated_cost = $job->estimated_cost ?? "N/A";
        $job->job_description = $job->job_description ?? "N/A";
        $job->supervisor_name = $job->supervisor_name ?? "N/A";
        $job->supervisor_mobile_no = $job->supervisor_mobile_no ?? "N/A";

        $job->customer = User::where('id', $job->customer_id)->get();

        foreach ($job->customer as $job1) {
            
            $job1->name = $job1['name'] ? $job1['name'] : 'N/A';
         
            $job1->customer_details = DB::table('customer_details')->where('_user_id', $job->customer_id)->get();

            foreach ($job1->customer_details as $job2) {
               $job1->email = $job1['email'] ? $job1['email'] : 'N/A';

                $job1->email_verified_at = $job1['email_verified_at'] ? $job1['email_verified_at'] : '0';

                $job1->photo = $job1['photo'] ? $job1['photo'] : 'N/A';

                $job1->username = $job1['username'] ? $job1['username'] : 'N/A';

                $job1->image = $job1['image'] ? $job1['image'] : 'N/A';

                $job1->gender = $job1['gender'] ? $job1['gender'] : 'N/A';

                $job1->deleted_at = $job1['deleted_at'] ? $job1['deleted_at'] : '0';

                $job1->created_at = $job1['created_at'] ? $job1['created_at'] : '0';

                $job1->updated_at = $job1['updated_at'] ? $job1['updated_at'] : '0';

            }
        }

        if ($job->product_image) {
            $job->product_image = asset('product_image/' . $job->product_image);
        } else {
            $job->product_image = 'N/A';
        }
        // if ($job->helpers != null) {
        //     $job->helpers = $job->helpers ?? [];
        // } else {
        //     $job->helpers['id']  = '0';
        //     $job->helpers['name']  = 'N/A';
        //     $job->helpers['mobile_number']  = 'N/A';
        //     $job->helpers['aadhar_no']  = 'N/A';
        //     $job->helpers['birthdate']  = 'N/A';
        //     $job->helpers['joindate']  = 'N/A';
        //     $job->helpers['license_no']  = 'N/A';
        //     $job->helpers['address']  = 'N/A';
        // }
         $job->helpers = $job->helpers ?? [
            'id' => '0',
            'name' => 'N/A',
            'mobile_number' => 'N/A',
            'aadhar_no' => 'N/A',
            'birthdate' => 'N/A',
            'joindate' => 'N/A',
            'license_no' => 'N/A',
            'address' => 'N/A',
        ];
        $job['helper_data'] = $job->helpers;
        // dd($job);
        return view('job.show',compact('job','id'));
    } catch (\Exception $e) {
        return redirect()->back()->with('success','data not found');
    }
    }

    function search_job($status)
    {
        return view('job.view',compact('status'));
    }

    function job_create_add(Request $request)
    {
        $data=$request->all();
        $validated = $request->validate([
            'technician_id' => 'required',
            'helper_id' => 'required',
            'payment_type' => 'required',
            'job_ref_no' => 'required|unique:jobs',

        ]);
        // echo "<pre>";
            // print_r($data);exit;
            $product_image="";
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $filename = date('ymdhis').$image->getClientOriginalName();
                $path = public_path('product_image');
                $image->move($path, $filename);
                $product_image=$filename;
            }

            $res = [
                'customer_id' => $data['customer_id'],
                'complaint_id' => $data['complaint_id'],
                'job_ref_no' => $data['job_ref_no'],
                'priority' => $data['priority'],
                'job_start_time' => 'N/A',
                'job_end_time' => 'N/A',
                'product' => 'N/A',
                'product_model_details' => 'N/A',
                'payment_type' => $data['payment_type'],
                'estimated_cost' => $data['estimated_cost'],
                'job_category' => $data['job_category'],
                'job_description' => $data['job_description'],
                'job_remark' => $data['job_remark'],
                'address' => $data['address'],
                'supervisor_name' => $data['supervisor_name'],
                'supervisor_mobile_no' => $data['supervisor_mobile_no'],
                'status' => $data['status'],
                'technician_id' => $data['technician_id'],
                'helper_id' => $data['helper_id'],
                'product_image' => $product_image,
                'customer_review' => 'N/A',
                'customer_rating' => '0',
                'signature' => 'N/A',
                'contact_p_name' => $data['contact_p_name'] ?? 'N/A',
                'contact_p_mobile_no' => $data['contact_p_mobile_no'] ?? 'N/A',

        ];


            $job = new job($res);
          $res_data=  $job->save();
         if($res_data)
         {
          return  redirect()->route('list.job',"all");
         }

    }

    public function crone_job(Request $request)

    {
        $jobList = job::where('status','Assign')->select('id','job_ref_no','created_at')->get();

        foreach ($jobList as $job) 
        {
            $job->job_ref_no = $job->job_ref_no;
            $date = $job->created_at;
            $job->created_at = $date;
            $carbon_date = Carbon::parse($date);
            $carbon_date->addHours(24);
            
            $job->carbon_date = $carbon_date;
            $job->current = Carbon::now();

            if($carbon_date >= $job->current)
            {
                $job->jobstatus = '1';
            }
            else
            {
                $job->jobstatus = '0';

                $update=DB::table('jobs')->where('id',$job->id)->update([
                    "status"=>'Pending',
                    'updated_at'=>date('Y-m-d H:i:s'),
                ]);
            }

        }

        return response()->json(['success'=>true ,'data' => 'Success'],200);

    }


    function del_notification(Request $request)

    {
        DB::table('local_notification_user')->delete();
        return redirect()->back();
    }

    public function categorywiseJobList(Request $request,$id)
    {
        $category = JobCategory::find($id);
        if ($category) {
            $jobs = DB::table('jobs')
            ->join('users', 'jobs.customer_id', '=', 'users.id')
            ->where('jobs.job_category', 'LIKE', '%' . $category->category . '%')
            ->where([['jobs.status','<>','Complete'],['jobs.status','<>','Reject']])
            ->select('jobs.*', 'users.name')
            ->get();
        } else {
            return redirect()->back();
        }
        
        // if($request->get('search') != '')
        // {
        //     $value = $request->get('search');
        //     $jobs = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')->select('jobs.*', 'users.name')->Where('users.name', 'like', "%{$value}%")->orWhere('jobs.job_ref_no', 'like', "%{$value}%")->get();
        // }
        // else
        // {
        //      $jobs = DB::table('jobs')
        //         ->join('users', 'jobs.customer_id', '=', 'users.id')
        //         ->select('jobs.*', 'users.name')
        //         ->get();
        // }
        return view('job.categorywise-list',compact('jobs','category'));
    }
    
}
