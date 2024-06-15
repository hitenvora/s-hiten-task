<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AMC;

use App\Models\CustomerDetails;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class AMCController extends Controller

{

    //

    function expire_amc_form(Request $request,$id)

    {

       // echo $id;exit;

       $geAMCeData=AMC::where('id' ,$id)->first();

       //print_r($geAMCeData);exit;

        $addresids=explode(',',$geAMCeData->_customer_details_id);

        $GetCustomerDetail=CustomerDetails::where('_user_id',$geAMCeData->_user_id)->get();

//  print_r($GetCustomer_detail);exit;

        return view('amc.renew_amc',compact('geAMCeData','GetCustomerDetail','addresids'));

    }

    function expire_amc()

    {

        //$getExpireData=AMC::where('end_date' ,'<=',date('Y-m-d'))->get();


        $getExpireData = DB::table('amcs')
                    ->leftJoin('customer_details', function ($join) {
                        $join->on(DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'), '>', DB::raw('0'));
                    })
                    ->leftJoin('users', 'amcs._user_id', '=', 'users.id')
                    ->where('amcs.end_date' ,'<=',date('Y-m-d'))
                    ->select('amcs.*', 'users.name',DB::raw('GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type'))
                    ->groupBy(
                        'amcs.id', 'amcs._user_id', 'amcs._customer_details_id', 'amcs.contract_type','amcs.amc_type',
                        'amcs.start_date', 'amcs.end_date', 'amcs.deleted_at', 'amcs.created_at',
                        'amcs.updated_at', 'amcs.contract_amount', 'users.name','amcs.ac_id'
                    )
                    ->orderBy('amcs.id', 'DESC')
                    ->get();

       //print_r($getExpireData);exit;



        return view('amc.expire',compact('getExpireData'));

    }

    public function end_amc()
    {
    //    return $getEndData = DB::table('amcs')
    //     ->leftJoin('customer_details', function ($join) {
    //         $join->on(DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'), '>', DB::raw('0'));
    //     })
    //     ->leftJoin('users', 'amcs._user_id', '=', 'users.id')
    //     ->leftJoin('amc_visit', 'amcs.id', '=', 'amc_visit._amc_id')
    //     ->where('amc_visit.visit_date', '>', date('Y-m-d')) // Filter for upcoming visits
    //     ->select('amcs.*', 'users.name', DB::raw('GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type'))
    //     ->groupBy(
    //         'amcs.id', 'amcs._user_id', 'amcs._customer_details_id', 'amcs.contract_type', 'amcs.amc_type',
    //         'amcs.start_date', 'amcs.end_date', 'amcs.deleted_at', 'amcs.created_at',
    //         'amcs.updated_at', 'amcs.contract_amount', 'users.name'
    //     )
    //     ->get();
        //     $getEndData = DB::table('amcs')
        //     ->leftJoin('customer_details', function ($join) {
        //         $join->on(DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'), '>', DB::raw('0'));
        //     })
        //     ->leftJoin('users', 'amcs._user_id', '=', 'users.id')
        //     ->leftJoin('amc_visit', function ($join) {x
        //         $join->on('amcs.id', '=', 'amc_visit._amc_id')
        //             ->where('amc_visit.visit_date', '=', function ($query) {
        //                 $query->select(DB::raw('MAX(visit_date)'))
        //                     ->from('amc_visit')
        //                     ->whereColumn('amc_visit._amc_id', 'amcs.id');
        //             });
        //     })
        //     ->where('amc_visit.visit_date', '>=', date('Y-m-d'))
        //     ->select(
        //         'amcs.id',
        //         'amcs._user_id',
        //         'amcs._customer_details_id',
        //         'amcs.contract_type',
        //         'amcs.amc_type',
        //         'amcs.start_date',
        //         'amcs.end_date',
        //         'amcs.deleted_at',
        //         'amcs.created_at',
        //         'amcs.updated_at',
        //         'amcs.contract_amount',
        //         'users.name',
        //         'users.phone_no',
        //         DB::raw('GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type'),
        //         'amc_visit.visit_date as upcoming_visit'
        //     )
        //     ->groupBy(
        //         'amcs.id', 'amcs._user_id', 'amcs._customer_details_id', 'amcs.contract_type', 'amcs.amc_type',
        //         'amcs.start_date', 'amcs.end_date', 'amcs.deleted_at', 'amcs.created_at',
        //         'amcs.updated_at', 'amcs.contract_amount', 'users.name', 'users.phone_no', 'amc_visit.visit_date'
        //     )
        //     ->orderBy('amc_visit.visit_date', 'asc')
        //     ->whereBetween('amc_visit.visit_date', [date('Y-m-d'), date('Y-m-d', strtotime('+30 days'))])
        // ->get();
        $currentDate = Carbon::now();
        $endOfMonth = $currentDate->copy()->addDays(30)->endOfMonth()->toDateString();

        // Get the last day of the current month
$endOfMonth = $currentDate->copy()->endOfMonth()->toDateString();

// Get the first day of the next month
$firstOfNextMonth = $currentDate->copy()->endOfMonth()->addDay()->toDateString();
$getEndData = DB::table('amc_visit')
            ->join('amcs', 'amc_visit._amc_id', '=', 'amcs.id')
            ->join('customer_details', 'amcs._user_id', '=', 'customer_details._user_id') // Adjust this join condition
    ->join('users', 'customer_details._user_id', '=', 'users.id')
    ->where(function ($query) use ($currentDate, $endOfMonth, $firstOfNextMonth) {
                $query->where('amc_visit.visit_date', '>=', $currentDate)
                    ->where('amc_visit.visit_date', '<=', $endOfMonth)
            ->orWhere('amc_visit.visit_date', '>=', $firstOfNextMonth);
    })
            ->get();


        // dd($getEndData);
                return view('amc.end-amc',compact('getEndData'));
    }

    function search_expire()
    {

        //$getExpireData=AMC::where('end_date' ,'<=',date('Y-m-d'))->get();
        $getExpireData = DB::table('amcs')

                    ->leftJoin('customer_details', function ($join) {

                        $join->on(DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'), '>', DB::raw('0'));

                    })

                    ->leftJoin('users', 'amcs._user_id', '=', 'users.id')

                    ->where('amcs.end_date' ,'<=',date('Y-m-d'))

                    ->select('amcs.*', 'users.name',DB::raw('GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type'))

                    ->groupBy(

                        'amcs.id', 'amcs._user_id', 'amcs._customer_details_id', 'amcs.contract_type','amcs.amc_type',

                        'amcs.start_date', 'amcs.end_date', 'amcs.deleted_at', 'amcs.created_at',

                        'amcs.updated_at', 'amcs.contract_amount', 'users.name'

                    )

                    ->get();

       //print_r($getExpireData);exit;



        return view('amc.expire',compact('getExpireData'));

    }

    

    function view()

    {

        $getAddress=DB::table('customer_details')->get();

        return view('amc.view',compact('getAddress'));

    }

    

    // function create_add_amc()

    // {

    //     $getAddress=DB::table('customer_details')->get();

    //     return view('amc.add',compact('getAddress'));

    // }

    function list()

    {

        return view('amc.view');

    }

    function search_amc()

    {

        return view('amc.view');

    }

    

      function create(Request $request)

    {



        return view('amc.add');



    }

    

    function create_add(Request $request)
    {
        $data=$request->all();
        // print_r($data['_customer_details_id']);
        // $startDate = $data['start_date'];
        // $startDateObj = Carbon::parse($startDate);
        // $endDateObj = $startDateObj->addYear();
        // $endDate = $endDateObj->toDateString();
        // $id=DB::table('amcs')->insertGetId([
        //     '_user_id' => $data['_user_id'],
        //     // '_customer_details_id' =>implode(',',$data['_customer_details_id']),
        //     // 'contract_type' =>$data['contract_type'],
        //     // 'start_date' =>$data['start_date'],
        //     // 'end_date' =>$endDate,
        //     // 'contract_amount' =>$data['contract_amount'],
        //     // 'created_at' =>date('Y-m-d H:i:s'),
        //     // 'updated_at' =>date('Y-m-d H:i:s'),
        //     // 'amc_type' =>$data['amc_type'],
        // ]);

        // if (isset($data['_customer_details_id'])) {
        //     foreach ($data['_customer_details_id'] as $key => $value) {
        //         $startDate = $data['start_date'][$key];
        //         $startDateObj = Carbon::parse($startDate);
        //         $endDateObj = $startDateObj->addYear();
        //         $endDate = $endDateObj->toDateString();
        //         $interval = $startDateObj->diff($endDateObj);
        //         $daysBetween = $interval->days;
        //         $addressId = DB::table('amcs')->insertGetId([
        //             '_user_id' => $data['_user_id'],
        //             '_customer_details_id' =>$data['_customer_details_id'][$key],
        //             'contract_type' => $data['contract_type'][$key],
        //             'start_date' => $data['start_date'][$key],
        //             'end_date' => $endDate,
        //             'contract_amount' =>$data['contract_amount'][$key],
        //             'amc_type' =>$data['amc_type'][$key],
        //             'ac_id' =>implode(',',$data['actypes'][$key]),
        //             'created_at' =>date('Y-m-d H:i:s'),
        //             'updated_at' =>date('Y-m-d H:i:s'),
        //         ]);

        //         $visit = $data['visit'][$key];
        //         $intervalBetweenVisits = floor($daysBetween / $visit);
        //         $start = $startDate;
        //         for ($i = 1; $i <= $visit; $i++) {
        //             $result = new DateTime($start);
        //             // Calculate visit date based on the current iteration
        //             $result->modify("+" . ($i * $intervalBetweenVisits) . " days");
        //             $day = $result->format('d');
        //             $month = $result->format('m');
        //             $year = $result->format('Y');
        //             $visitDate = sprintf('%04d-%02d-%02d', $year, $month, $day);

        //             DB::table('amc_visit')->insert([
        //                 "_amc_id" => $addressId,
        //                 "visit_date" => $visitDate,
        //                 "customerid" => $data['_user_id'],
        //                 "status" => 0,
        //                 "created_at" => now(),
        //                 "updated_at" => now(),
        //             ]);

        //             $start = $result->format('Y-m-d');
        //         }
        //     }
        // }




        if (isset($data['_customer_details_id'])) {
            // dd($data['_customer_details_id']);
            foreach ($data['_customer_details_id'] as $key => $value) {
                
                $startDate = $data['start_date'][$key];
                $startDateObj = Carbon::parse($startDate);
                $endDateObj = $startDateObj->copy()->addYear();
                $endDate = $endDateObj->toDateString();
                $interval = $startDateObj->diff($endDateObj);
                $daysBetween = $interval->days;
                
                $addressId = DB::table('amcs')->insertGetId([
                    '_user_id' => $data['_user_id'],
                    '_customer_details_id' => $data['_customer_details_id'][$key],
                    'contract_type' => $data['contract_type'][$key],
                    'start_date' => $data['start_date'][$key],
                    'end_date' => $endDate,
                    'contract_amount' => $data['contract_amount'][$key],
                    'amc_type' => $data['amc_type'][$key],
                    'ac_id' => implode(',', $data['actypes'][$key]),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        

                // Check if $visit is a string and not empty
          
                // Now $visitArray will contain the values from the string $visit separated by commas
                // You can use $visitArray for further processing
                



                // $visit = $data['visit'][$key];
                // $daysBetween = $startDateObj->diffInDays($endDateObj);
                // $intervalBetweenVisits = floor($daysBetween / $visit);
                $visit = $data['visit'][$key]; // Assuming $data['visit'] contains integer values
             
                // dd($visitArray);
                $daysBetween = $startDateObj->diffInDays($endDateObj);

                // dd($visit, $daysBetween);
                $intervalBetweenVisits = floor((int) $daysBetween / (int) $visit);

                // if (!empty($visit) && is_numeric($visit)) {
                //     // Convert $visit to integer to ensure correct division
                //     $visit = (int) $visit;

                //     // Avoid division by zero
                //     if ($visit != 0) {
                //         $intervalBetweenVisits = floor($daysBetween / $visit);
                //     }
                // }
                
                for ($i = 0; $i < $visit; $i++) {
                    $visitDate = $startDateObj->copy()->addDays($i * $intervalBetweenVisits)->toDateString();

                    DB::table('amc_visit')->insert([
                        "_amc_id" => $addressId,
                        "visit_date" => $visitDate,
                        "customerid" => $data['_user_id'],
                        "status" => 0,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ]);
                }
            }
        }
        return redirect()->route('list.amc');
    }

    function upcuming_amc()

    {

        return view('amc.up_comming');

    }

    function search_upcomming()

    {

        return view('amc.up_comming');

    }

    function pending_amc()

    {

        return view('amc.pending');

    }

    function search_pending()

    {

        return view('amc.pending');

    }

    function del_amc(Request $request)

    {

        $data=$request->all();

        DB::table('amcs')->where('id',$data['id'])->delete();
        DB::table('amc_visit')->where('_amc_id',$data['id'])->delete();

        return redirect()->back();

    }

    function edit_amc(Request $request)
    {
        $data=$request->all();

        // print_r($data);

        $userData=AMC::find($request->id);

        // print_r($userData);

        $getDetails=DB::table('amc_visit')->where('_amc_id',$request->id)->get();
        // dd($getDetails);

        $getAddress=DB::table('customer_details')->select('id','location_type')->where('_user_id',$userData->_user_id)->get();

       // print_r($getDetails);

        return view('amc.edit',compact('userData','getDetails','getAddress'));

    }

    function update_amc(Request $request)
    {

        $data=$request->all();
        // dd($data);

        // print_r($request->_customer_details_id);

        if($request->_customer_details_id == '')
        {
            $startDate = $data['start_date'];
            $startDateObj = Carbon::parse($startDate);
            $endDateObj = $startDateObj->addYear();
            $endDate = $endDateObj->toDateString();
            $update_data=[
                '_user_id' => $data['_user_id'],
        
                'contract_type' =>$data['contract_type'],
        
                'start_date' =>$data['start_date'],
        
                'contract_amount' =>$data['contract_amount'],
        
                'end_date' =>$endDate,
        
                'created_at' =>date('Y-m-d H:i:s'),
        
                'updated_at' =>date('Y-m-d H:i:s'),
        
                'amc_type' =>$data['amc_type'],
    
            ];
    
    
           $update= DB::table("amcs")->where('id',$data['id'])->update($update_data);


           
           
           if($update)
           {

            foreach ($data['visit_date1'] as $key => $value) {

                DB::table('amc_visit')->insert(["_amc_id"=>$data['id'],"visit_date"=>$value,"customerid"=>$data['_user_id'],"status"=>0,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')]);
    
            }
    
    
               return redirect()->route('list.amc');
    
           }
        }
        else
        {
            
            // die;

            $startDate = $data['start_date'];
            $startDateObj = Carbon::parse($startDate);
            $endDateObj = $startDateObj->addYear();
            $endDate = $endDateObj->toDateString();
            $update_data=[
                '_user_id' => $data['_user_id'],
    
                '_customer_details_id' =>implode(',',$data['_customer_details_id']),
        
                'contract_type' =>$data['contract_type'],
        
                'start_date' =>$data['start_date'],
        
                'contract_amount' =>$data['contract_amount'],
        
                'end_date' =>$endDate,
        
                'created_at' =>date('Y-m-d H:i:s'),
        
                'updated_at' =>date('Y-m-d H:i:s'),
        
                'amc_type' =>$data['amc_type'],
    
            ];
    
    
           $update= DB::table("amcs")->where('id',$data['id'])->update($update_data);

           if($update)

           {

                if (isset($data['visit_date1'])) {

                
                foreach ($data['visit_date1'] as $key => $value) {

                $select= DB::table("amc_visit")->where('_amc_id',$data['id'])->where('visit_date',$value)->count();
                if($select > 0)
                {

                        }
                else
                {
                        
                    DB::table('amc_visit')->insert(["_amc_id"=>$data['id'],"visit_date"=>$value,"customerid"=>$data['_user_id'],"status"=>0,"created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')]);
                }
                    }
                    
            }
    
    
               return redirect()->route('list.amc');
    
           }
    
        }

     

    }

    function del_address_amc(Request $request)

    {

        $data=$request->all();

        DB::table('amc_visit')->where('id',$data['id'])->delete();

        return redirect()->back();

    }

}

