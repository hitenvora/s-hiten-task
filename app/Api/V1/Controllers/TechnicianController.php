<?php



namespace App\Api\V1\Controllers;

use App\Models\JobSubCategory;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Log;

use App\Traits\File;

use App\Traits\CaptureIpTrait;

use App\Models\User;

use App\Models\job;

use App\Models\Technician;
use App\Models\TrackLocation;

use App\Models\JobCategory;

use App\Traits\UserTraits;

use App\Api\ApiController;

use App\Models\Attendance;

use App\Models\Termsmodel;

use App\Models\JobServiceItem;

use App\Models\local_notification_user;

use Illuminate\Http\Request;

use F9Web\ApiResponseHelpers;

use App\Traits\CommonCodeTrait;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;


class TechnicianController extends ApiController

{

    use  File;



    /* public function __construct()

      {

          $this->middleware('auth:api');

      }*/

    public function myProfile(){

         $technician = Technician::where('id',Auth::guard('api')->user()->id)->first();

         $technician['profile_image'] = asset('technician_images/'.$technician->profile_image);

         return response()->json(['success'=>true ,'data' => $technician],200);



    }





    public function changePassword(Request $request)

    {
        $this->validateRequest('change-password');

        $user = User::whereId(auth()->user()->id)->whereStatus(ApiController::$ACTIVE)->first();

        if (!$user) return $this->successFailResponse('api.user_not_found', ApiController::$FAIL);

        if (Hash::check($request->old_password, $user->password) == false) return $this->successFailResponseWithMetaData('api.old_password_wrong', ApiController::$FAIL, ApiController::$SUCCESS_STATUS);



        $user->password = Hash::make($request->new_password);

        $user->save();

        return $this->successFailResponseWithMetaData('api.password_update_successfully', ApiController::$SUCCESS, ApiController::$SUCCESS_STATUS);

    }



   public function jobList(Request $request)

    {

        // $jobList = job::with('customer','customer.customerDetails')->where('technician_id',Auth::guard('api')->user()->id)->get();

        // $jobList->each(function ($job) 

        // {

        //     $job->product_image = asset('product_image/'. $job->product_image);

        //     $job->job_end_time = $job->job_end_time ?? "";

        //     $job->job_completion_at = $job->job_completion_at ?? "";

        //     $job->product_model_details = $job->product_model_details ?? "";

        //     $job->city = $job->city ?? "";

        //     $job->postal_code = $job->postal_code ?? "";

        //     $job->deleted_at = $job->deleted_at ?? "";

        // });

        

        $jobList = job::where('technician_id',Auth::guard('api')->user()->id)->get();
        // $currentTime = now();
        foreach ($jobList as $job) 
        {
            // $createdAt = \Carbon\Carbon::parse($job->created_at);
            // $hoursDifference = $currentTime->diffInHours($createdAt);
            // if ($hoursDifference >= 24 && $job->status !== 'pending') {
            //     $job->status = 'pending';
            //     $job->save(); 
            // }
            $job->product_image = asset('product_image/'. $job->product_image);

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

            $job->customer = User::where('id',$job->customer_id)->get();

            

            foreach ($job->customer as $job1) 

            {

                $job1->name = $job1['name'] ? $job1['name'] : 'N/A';

                $job1->email = $job1['email'] ? $job1['email'] : 'N/A';

                $job1->email_verified_at = $job1['email_verified_at'] ? $job1['email_verified_at'] : '0';

                $job1->photo = $job1['photo'] ? $job1['photo'] : 'N/A';

                $job1->username = $job1['username'] ? $job1['username'] : 'N/A';

                $job1->image = $job1['image'] ? $job1['image'] : 'N/A';

                $job1->gender = $job1['gender'] ? $job1['gender'] : 'N/A';

                $job1->deleted_at = $job1['deleted_at'] ? $job1['deleted_at'] : '0';

                $job1->created_at = $job1['created_at'] ? $job1['created_at'] : '0';

                $job1->updated_at = $job1['updated_at'] ? $job1['updated_at'] : '0';

                $job1->customer_details = DB::Table('customer_details')->where('_user_id',$job->customer_id)->get();
                foreach ($job1->customer_details as $job2) 
                {
                    $job2->created_at = $job2->created_at;
                    if($job2->created_at == '')
                    {
                        $job2->created_at ='N/A';
                    }
                    $job2->updated_at = $job2->updated_at;
                    if($job2->updated_at == '')
                    {
                        $job2->updated_at ='N/A';
                    }

                }

            }

        }

           return response()->json(['success'=>true ,'data' => $jobList],200);

    }



public function searchJobs(Request $request)
{
    $search = $request->input('search');

    if (empty($search)) {
        return response()->json(['success' => false, 'message' => 'Search parameter is required'], 400);
    }


    $jobs = job::where('technician_id', Auth::guard('api')->user()->id)
        ->where(function ($query) use ($search) {
            $query->where('job_ref_no', 'like', '%' . $search . '%')
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        })
        ->get();

    if ($jobs->isEmpty()) {
        return response()->json(['success' => false, 'message' => 'No matching jobs found'], 200);
    }

    $formattedJobs = $jobs->map(function ($job) {
        $job->product_image = asset('product_image/' . $job->product_image);
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
            $job1->email = $job1->email ? $job1->email : 'N/A';
            $job1->email_verified_at = $job1->email_verified_at ? $job1->email_verified_at : '0';
            $job1->photo = $job1->photo ? $job1->photo : 'N/A';
            $job1->username = $job1->username ? $job1->username : 'N/A';
            $job1->image = $job1->image ? $job1->image : 'N/A';
            $job1->gender = $job1->gender ? $job1->gender : 'N/A';
            $job1->deleted_at = $job1->deleted_at ? $job1->deleted_at : '0';
            $job1->created_at = $job1->created_at ? $job1->created_at : '0';
            $job1->updated_at = $job1->updated_at ? $job1->updated_at : '0';
        }

        $job1->customer_details = DB::table('customer_details')->where('_user_id', $job->customer_id)->get();

        foreach ($job1->customer_details as $job2) {
            $job2->created_at = $job2->created_at ? $job2->created_at : 'N/A';
            $job2->updated_at = $job2->updated_at ? $job2->updated_at : 'N/A';
        }

        return $job;
    });

    return response()->json(['success' => true, 'data' => $formattedJobs], 200);
}

public function updateStatus(Request $request)
{

    $job_id = $request->input('job_id');
    $status = $request->input('status', '5');

    $job = Job::find($job_id);

    if (!$job) {
        return response()->json(['message' => 'Job not found'], 404);
    }

    $job->status = $status;
    $job->save();

    return response()->json(['message' => 'Job status updated', 'data' => $job], 200);
}

public function jobUpdateCategory(Request $request)
{

    $job_id = $request->input('job_id');
    $category = $request->input('category');

    $job = Job::find($job_id);

    if (!$job) {
        return response()->json(['message' => 'Job not found'], 404);
    }

    $job->job_category = $category;
    $job->save();

    return response()->json(['message' => 'Job Category Add', 'data' => $job], 200);
}



public function statushold(Request $request)
{

    $job_id = $request->input('job_id');
    $status = $request->input('status', '2');

    $job = Job::find($job_id);

    if (!$job) {
        return response()->json(['message' => 'Job not found'], 404);
    }

    $job->status = $status;
    $job->save();

    return response()->json(['message' => 'Job status updated', 'data' => $job], 200);
}

public function statuscomplate(Request $request)
{

    $job_id = $request->input('job_id');
    $review = $request->customer_review;
    $rating = $request->customer_rating;
    $status = $request->input('status', '4');
    $description = $request->category_description;

    $job = Job::find($job_id);

    if (!$job) {
        return response()->json(['message' => 'Job not found'], 404);
    }

    $job->status = $status;
    $job->customer_review = $review;
    $job->customer_rating = $rating;
    $job->category_description = $description ? $request->category_description : 'N/A';
    
    if($request->signature){

        $filename = $this->resizeImage($request->signature,'/technician_images');

        $job->signature =  $filename;

    }
    $job->save();

    return response()->json(['message' => 'Job status updated', 'data' => $job], 200);
}


public function jobDetails(Request $request)
{
    // print_r(Auth::guard('api')->user()->id);
    try {
        // $job = job::where('id', $request->job_id)
        //     ->where('technician_id', Auth::guard('api')->user()->id)
        //     ->first();

            $job = Job::with('helpers')
            ->where('id', $request->job_id)
            ->where('technician_id', Auth::guard('api')->user()->id)
            ->first();
        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

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
        $job->job_remark = $job->job_remark ?? "N/A";
        $job->supervisor_name = $job->supervisor_name ?? "N/A";
        $job->supervisor_mobile_no = $job->supervisor_mobile_no ?? "N/A";
        $job->category_description = $job->category_description ?? "N/A";
        $job->job_subcategory = $job->job_subcategory ?? "N/A";
        $job->complaint_image = $job->complaint_image ?? "N/A";

        $job->customer = User::where('id', $job->customer_id)->withTrashed()->get();

        foreach ($job->customer as $job1) {
            
            $job1->name = $job1['name'] ? $job1['name'] : 'N/A';
         
            $job1->customer_details = DB::table('customer_details')->where('_user_id', $job->customer_id)->get();
            $job1->latlong = $job1['latlong'] ? $job1['latlong'] : 'N/A';
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
            'id' => 0,
            'name' => 'N/A',
            'mobile_number' => 'N/A',
            'aadhar_no' => 'N/A',
            'license_no' => 'N/A',
            'address' => 'N/A',
        ];
        $job['helper_data'] = $job->helpers;
        return response()->json(['success' => true, 'data' => $job], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}


    public function Category()
    {
        $category = JobCategory::all();
        foreach ($category as $key) 
        {
            $key['subcategory'] = JobSubCategory::where('job_category_id', $key['id'])->get();
        }
        return response()->json(['success' => true, 'data' => $category], 200);
    }

    public function Subcategory(Request $request)
    {
        // $job = Job::find($request->job_id);
        // // dd(explode(',', $job->job_subcategory));
        // foreach (explode(',', $job->job_subcategory) as $key => $value) {
        //     $subcategory = JobSubCategory::where('job_category_id',$request->category_id)->get();
        // }
        // return response()->json(['success' => true, 'data' => $subcategory], 200);

        $job = Job::find($request->job_id);
        $subcategoryData = [];
        // Get all subcategories related to the specified category
        $allSubcategories = JobSubCategory::where('job_category_id', $request->category_id)->get();
        foreach ($allSubcategories as $subcategory) {
            // Check if the subcategory is in the job's subcategories
            $subcategory->select_status = in_array($subcategory->id, explode(',', $job->job_subcategory)) ? 1 : 0;
            $subcategoryData[] = $subcategory;
        }
        return response()->json(['success' => true, 'data' => $subcategoryData], 200);
    }

    public function updateSubcategory(Request $request)
    {
        // $job = job::find($request->id);
        // $job->job_subcategory = $request->subcategory;
        // $job->save();
        // return response()->json(['success' => true, 'data' => $job], 200);

        #Job In subcategory ID
        // $job = Job::find($request->job_id);
        // if ($job) {
        //     // Ensure $request->subcategory is an array
        //     $subcategoryArray = is_array($request->subcategory) ? $request->subcategory : explode(',', $request->subcategory);
        //     $formattedSubcategory = implode(',', $subcategoryArray);
        //     $job->job_subcategory = $formattedSubcategory;
        //     $job->save();
        //     #Bill Amount
        //     $subcategoryData = [];
        //     $total = 0;
        //     foreach (explode(',', $job->job_subcategory) as $key => $value) {
        //         $subcategory = JobSubCategory::find($value);
        //         if ($subcategory) {
        //             // Match found, set status to 1
        //             $total +=  $subcategory->price;
        //             $job->bill_amount = $total;
        //             $job->save();
        //         } else {
        //             // No match found, set status to 0
        //         }
        //         $subcategoryData[] = $subcategory;
        //     }
        //     return response()->json(['success' => true, 'data' => $job], 200);
        // } else {
        //     return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        // }


        // $job = Job::find($request->job_id);
        // if ($job) {

        //     $subcategoryArray = $request->subcategory;
        //     $jobdata = Job::where('id',$request->job_id)->first();
        //     $job_subcategory = $jobdata->job_subcategory;
        //     $job_quantity = $jobdata->job_quantity;
        //     // Ensure $request->subcategory is an array
            
        //     $job->job_subcategory = $job_subcategory.','.$request->subcategory;
        //     $job->job_quantity = $job_quantity.','.$request->quantity;
        //     // $job->save();

        //     $priceeedata = JobSubCategory::find($request->subcategory);
        //     $price =  $priceeedata->price;
        //     $totalamt = $price * $request->quantity;

        //     $jobservice = new JobServiceItem();
        //     $jobservice->job_id = $request->job_id;
        //     $jobservice->subcategory = $request->subcategory;
        //     $jobservice->quantity = $request->quantity;
        //     $jobservice->price = $price;
        //     $jobservice->total = $totalamt;
        //     $jobservice->save();

        //     $bill_amount = 0;
        //     $servicedata = JobServiceItem::where('job_id',$request->job_id)->get();
        //     foreach ($servicedata as $key) 
        //     {
        //         $price = $key->total;
        //         $bill_amount = $price + $bill_amount;
        //     }

        //     $job->bill_amount = $bill_amount;
        //     $job->save();

        //     return response()->json(['success' => true, 'data' => $job], 200);
        // } else {
        //     return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        // }

        header('Content-type: application/json'); 
        $json = file_get_contents('php://input'); 
        /*$obj = json_decode($json,true);*/

        $json = json_decode($json, true);

        // print_r($json);

        // echo "Job ID: ".$json["jobId"]."<br>";

        $job = Job::find($json["job_id"]);
        if ($job) {

           
        
            $jobservicedel = JobServiceItem::where('job_id',$json["job_id"])->delete();

            foreach ($json['subcategory'] as $car ) {
                // print_r('subCatName : '.$car['subCatId'].'<br>');
                // print_r('quantity : '.$car['quantity'].'<br>');

                $jobdata = Job::where('id',$json["job_id"])->first();
                $job_subcategory = $jobdata->job_subcategory;
                $job_quantity = $jobdata->job_quantity;

                $job->job_subcategory = $job_subcategory.','.$car['subCatId'];
                $job->job_quantity = $job_quantity.','.$car['quantity'];
                // $job->save();

                $priceeedata = JobSubCategory::find($car['subCatId']);
                $price =  $priceeedata->price;
                $totalamt = $price * $car['quantity'];

                $jobservice = new JobServiceItem();
                $jobservice->job_id = $json["job_id"];
                $jobservice->subcategory = $car['subCatId'];
                $jobservice->quantity = $car['quantity'];
                $jobservice->price = $price;
                $jobservice->total = $totalamt;
                $jobservice->save();
            }

            $bill_amount = 0;
            $servicedata = JobServiceItem::where('job_id',$json["job_id"])->get();
            foreach ($servicedata as $key) 
            {
                $price = $key->total;
                $bill_amount = $price + $bill_amount;
            }

            $job->bill_amount = $bill_amount;
            $job->save();

            return response()->json(['success' => true, 'data' => $job], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

    }

    public function checkStatus(){
        $tchnicianId =  Auth::guard('api')->user()->id;
        $findLastStatus = Attendance::where('technician_id',$tchnicianId)->orderBy('id', 'desc')->first();
       return response()->json(['success'=>true ,'data' => ['check_status' => $findLastStatus ? $findLastStatus->check_status : 'Out']],200);

    }

    public function receivedAmount(Request $request)
    {
        $job = Job::find($request->job_id);
        if ($job) {
            $job->received_amount = $request->received_amount;
            $job->save();
            return response()->json(['success' => true, 'data' => $job], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }   
    }

    public function billAmount(Request $request)
    {
        $job = Job::find($request->job_id);
        if ($job) {
            return response()->json(['success' => true, 'data' => $job], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }
        
    }


    public function changeCheckInCheckOut(Request $request){

        $validator = Validator::make($request->all(), [
            'check_time' => 'required',
            'longitude' =>'required',
            'latitude' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            // Return a response with validation errors
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $tchnicianId =  Auth::guard('api')->user()->id;
        $findLastStatus = Attendance::where('technician_id',$tchnicianId)->orderBy('id', 'desc')->first();

        if(!$findLastStatus){
               $findLastStatus = new Attendance();
               $findLastStatus->check_status = 'In';
         }else{
               if( $findLastStatus->check_status == 'In'){
                $findLastStatus = new Attendance();
                $findLastStatus->check_status = 'Out';
            }else{
                $findLastStatus = new Attendance();
                $findLastStatus->check_status = 'In';
            }
         }

         $findLastStatus->technician_id = $tchnicianId;
         $findLastStatus->check_time = $request->check_time;
         $findLastStatus->latitude = $request->latitude;
         $findLastStatus->longitude = $request->longitude;
         $findLastStatus->address = $request->address;
         $findLastStatus->save();
         return response()->json(['success'=>true ,'data' => ['check_status' => $findLastStatus->check_status]],200);
    }

    public function tracklocation(Request $request){

        $validator = Validator::make($request->all(), [
            'check_time' => 'required',
            'longitude' =>'required',
            'latitude' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $tchnicianId =  Auth::guard('api')->user()->id;

        $gettechniciancount = TrackLocation::where('technician_id',$tchnicianId)->orderby('id','DESC')->count();
        if($gettechniciancount > 0)
        {
            $gettechnician = TrackLocation::where('technician_id',$tchnicianId)->orderby('id','DESC')->first();
            $findLastStatus = TrackLocation::find($gettechnician->id);
        }
        else
        {
            $findLastStatus = new TrackLocation();
        }
        
        $findLastStatus->technician_id = $tchnicianId;
        $findLastStatus->check_time = $request->check_time;
        $findLastStatus->latitude = $request->latitude;
        $findLastStatus->longitude = $request->longitude;
        $findLastStatus->address = $request->address;
        $findLastStatus->save();
        return response()->json(['success'=>true ,'message' => 'Location added successfully'],200);
    }

    public function jobComplete(Request $request){

        $validator = Validator::make($request->all(), [
            'job_id' => 'required',
            'competition_date_time' =>'required',
        ]);
        if ($validator->fails()) {
            // Return a response with validation errors
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $technician = Technician::where('id',Auth::guard('api')->user()->id)->first();
        $jobComlete =  job::where('id',$request->job_id)->where('technician_id', Auth::guard('api')->user()->id)->first();

        if(!$jobComlete)   return response()->json(['success'=>false,'message' => 'Job not found' ],400);
        $jobComlete->job_completion_at = $request->competition_date_time;
        $jobComlete->status = 'Complete';
        $jobComlete->save();
        $ins=array(
            'noti_user_id'=>Auth::guard('api')->user()->id,
            'noti_type'=>'1',
            'noti_msg'=>'Your job is completed by Techinician : '.$technician->name.'. your Job ID is '.$jobComlete->job_ref_no,
            'noti_status'=>'1',
        );
        $local_notification = local_notification_user::create($ins);
        return response()->json(['success'=>true ,'data' => ['competition_date_time' => $jobComlete->job_completion_at ,'job_status' => $jobComlete->status]],200);
    }

    public function logOut(Request $request)
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function techniciancout()
    {
        $getassign=DB::table('jobs')->where('technician_id',Auth::guard('api')->user()->id)->where('status','Assign')->count();
        $complete=DB::table('jobs')->where('technician_id',Auth::guard('api')->user()->id)->where('status','Complete')->count();
        return response()->json(['success'=>true ,'assign' => $getassign,'complete' => $complete],200);
    }

    public function terms()
    {
        $terms = Termsmodel::all();
        return response()->json($terms);
    }
    public function getcategories()
    {
        $categories = JobCategory::all();
        return response()->json($categories);
    }

    public function updateCategory(Request $request)
    {
        $category = new JobCategory();
        $category->category = $request->input('category');
        $category->save();
        return response()->json(['message' => 'Job category created', 'data' => $category], 200);
    }

    public function privacyPolicy(){
        $data = "SK Entprice Privacy Policy." ;
        return response()->json(['success' => '1', 'data' => $data], 200);
    }
        
    public function aboutus(){
        $data = "SK Entprice AboutUs." ;
        return response()->json(['success' => '1', 'data' => $data], 200);
    }
}



