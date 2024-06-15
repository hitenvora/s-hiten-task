<?php



namespace App\Http\Controllers;



use App\Models\complaint;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;



class ComplaintController extends Controller

{

    //

    function complaint()

    {

        // return view("complaint.index");

        $totalComplaints = DB::table('complaints')->count();



        // Pass the variable to the view

        return view('complaint.index', ['totalComplaints' => $totalComplaints]);

        // return view('complaint.index', ['totalComplaints' => $totalComplaints]);

    }

    function search()

    {

        // return view("complaint.index");

        $totalComplaints = DB::table('complaints')->count();



        // Pass the variable to the view

        return view('complaint.index', ['totalComplaints' => $totalComplaints]);

        // return view('complaint.index', ['totalComplaints' => $totalComplaints]);

    }

    function edit_complaint(Request $request)
    {

        //echo $request->id;

        $complaint = complaint::where('id', $request->id)->first();

        return view("complaint.edit", compact('complaint'));
    }

    function create_complaint(Request $request)
    {

        $amcvisitID = $request->amcvisit_id;
    

        $getAddress = DB::table('customer_details')->get();
        $amcvisit = DB::table('amc_visit')->where('id', $amcvisitID)->get();
        $customer_show = DB::table('users')->where('id', $amcvisitID)->get();
        $getname = DB::table('customer_details')->where('id', $amcvisitID)->get();
        // dd($getname);
        // dd($customer_show);
        // dd($amcvisit);

        return view("complaint.add", compact("getAddress", "amcvisitID", "amcvisit","customer_show","getname"));
    }

    function del_complaint(Request $request)
    {

        //echo $request->id;

        $complaint = complaint::where('id', $request->id)->delete();



        // return redirect()->route('list.complaint');
        return redirect()->back();
    }

    function get_customer_address(Request $request)
    {
        // $getAddress=DB::table('customer_details')->where('_user_id',$request->User_Id)->get();
        // return response()->json($getAddress);
        $data['getAddress'] = DB::table('customer_details')->select('id', 'location_type')->where('_user_id', $request->User_Id)->get();
        return response()->json($data);
    }

    function get_customer_acdetail(Request $request)
    {
        // $getAddress=DB::table('customer_details')->where('_user_id',$request->User_Id)->get();
        // return response()->json($getAddress);
        $data['getAddress'] = DB::table('ac_detail')->where('address_id', $request->Address_ID)->get();
        return response()->json($data);
    }

    function get_customer_amc(Request $request)
    {
        // $getAddress=DB::table('customer_details')->where('_user_id',$request->User_Id)->get();
        // return response()->json($getAddress);
        $amc = DB::table('amcs')->where('_customer_details_id', $request->Address_Id)->latest()->first();
        if ($amc !== null) {
            $data = $amc;
        } else {
            $data = 'null';
        }
        
        return response()->json($data);
    }

    function get_customer_mobile(Request $request)

    {

        $data = User::where('id', $request->User_Id)->first();


        return response()->json($data->phone_no);
    }

    function update_complaint(Request $request)
    {

        $validated = $request->validate([
            'supervisor_id' => 'required',
          

        ]);

        $supervisor = DB::table('supervisors')->where('id',$request->supervisor_id)->first();
        $data = $request->all();
        $data = complaint::find($request->id);
        $data->_customer_id = $request->_customer_id;
        $data->_customer_address_id = $request->_customer_address_id;
        $data->item_description = $request->item_description;
        $data->remark = $request->remark;
        $data->priority = $request->priority;
        $data->job_category = $request->job_category;
        $data->amc_type = $request->amc_type;
        $data->supervisor_id = $request->supervisor_id;
        $data->contact_p_name = $request->contact_p_name;
        $data->contact_p_mobile_no = $request->contact_p_mobile_no;
        $data->supervisor_name = $supervisor->supervisor_name;
        $data->supervisor_mobile_no = $supervisor->supervisor_mobile_no;
        $data->payment_type = $request->payment_type;
        $data->status = 'Open';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('ymdhis') . $image->getClientOriginalName();
            $path = public_path('complaint_image');
            $image->move($path, $filename);
            $image_name = $filename;
            $data['image'] = $image_name;
            $data->save();
        }
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();
        return redirect()->route('list.complaint');
    }


    function add_complaint(Request $request)
    {
        
        $image_name = "";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('ymdhis') . $image->getClientOriginalName();
            $path = public_path('complaint_image');
            $image->move($path, $filename);
            $image_name = $filename;
            // $data_updat['image']=$filename;
        }
        $supervisor = DB::table('supervisors')->where('id',$request->supervisor_id)->first();
        $data = $request->all();
        $data = new complaint();
        $data->creadted_by = Auth::user()->id;
        $data->_customer_id = $request->_customer_id;
        $data->_customer_address_id = $request->_customer_details_id;
        $data->item_description = $request->item_description;
        $data->status = 'Open';
        $data->priority = $request->priority;
        $data->job_category = $request->job_category;
        $data->remark = $request->remark;
        $data->amc_type = $request->amc_type;
        $data->ref_no = $request->ref_no;
        $data->supervisor_id = $request->supervisor_id;
        $data->contact_p_name = $request->contact_p_name;
        $data->contact_p_mobile_no = $request->contact_p_mobile_no;
        $data->supervisor_name = $supervisor->supervisor_name;
        $data->supervisor_mobile_no = $supervisor->supervisor_mobile_no;
        $data->payment_type = $request->payment_type;
        $data->image = $image_name;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();

        if ($request->amcvisit_id !== null) {
            $amcVisit = DB::table('amc_visit')->where('id',$request->amcvisit_id)->first();
            if ($amcVisit) {
                DB::table('amc_visit')->where('id', $request->amcvisit_id)
                    ->update(['complaint_id' => $data->id]);
            }
        }
        return redirect()->route('list.complaint');
    }
}
