<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use App\Models\Profile;

use App\Models\Role;

use App\Models\Technician;

use App\Models\Attendance;

use App\Traits\CaptureIpTrait;

use App\Traits\File;

use Auth;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redis;

use Validator;

use Carbon\Carbon;

use DB;



class TechnicianManagementController extends Controller

{

    use File;

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        //     $this->middleware('auth');

    }



    public function index()
    {
        return view('technician.index');
    }

    public function search_technician()
    {
        return View('technician.index');
    }



    public function create()

    {

        // $roles = Role::all();

        return view('technician.create-technician');
    }



    public function technicianProfile(Request $request)
    {

        $technician = Technician::where('id', $request->id)->first();
        $attendance = Attendance::where('technician_id', $request->id)->whereYear('check_time', Carbon::now()->year)->whereMonth('check_time', Carbon::now()->month)->where('check_status', 'Out')->orderby('id', 'ASC')->get();
        $diff_in_hours = 0;
        $datamonthearn = Attendance::select('*')->whereMonth('check_time', Carbon::now()->month)->where('technician_id', $request->id)->get();
        $checkindate = "";
        $checkoutdate = "";
        foreach ($datamonthearn as $row) {
            $salary = $row->check_status;
            if ($row->check_status == "In") {
                $checkindate = $row->check_time;
            } else if ($row->check_status == "Out") {
                $checkoutdate = $row->check_time;
            }
            $checkin = Carbon::parse($checkindate)->format('Y-m-d H:i:s');
            $checkout = Carbon::parse($checkoutdate)->format('Y-m-d H:i:s');
            if ($checkin == $checkout) {
                $to1 = Carbon::createFromFormat('Y-m-d H:i:s', $checkindate);
                $from1 = Carbon::createFromFormat('Y-m-d H:i:s', $checkoutdate);
                $diff_in_hours111 = $to1->diffInHours($from1);
                $diff_in_hours = $diff_in_hours111 + $diff_in_hours;
            }
        }

        //  print_r('Final Hour :'. $diff_in_hours);

        //  $to1 = Carbon::createFromFormat('Y-m-d H:i:s', '2023-11-09 20:30:34');

        //  $from1 = Carbon::createFromFormat('Y-m-d H:i:s', '2023-11-09 9:30:34');

        //  $diff_in_hours = $to1->diffInHours($from1);

        //  print_r('Final Hour :'. $diff_in_hours);
        $tid = $request->id;

        return view('technician.view', compact('technician', 'diff_in_hours', 'tid'));
    }

    public function attendancelist(Request $request)
    {

        $id = $request->id;
        $technician = Technician::where('id', $request->id)->first();

        // $attendance = Attendance::where('technician_id',$request->id)->orderby('id','DESC')->get();
        if ($request->from_date && $request->to_date) {
            $attendance = DB::table('attendances')->whereBetween('check_time', [$request->from_date, $request->to_date])->where('technician_id', $request->id)
                ->select(DB::raw('DATE(check_time) as date'),)
                ->groupBy('date')
                ->get();

            $total_salaries = [];
            foreach ($attendance as $key => $attendances) {
                $attendancecountted = DB::table('attendances')
                    ->whereDate('check_time', $attendances->date)
                    ->where('technician_id', $id)
                    ->orderby('id', 'DESC')
                    ->count();

                if ($attendancecountted > 0) {
                    $attendancedetail = DB::table('attendances')
                        ->whereDate('check_time', $attendances->date)
                        ->where('technician_id', $id)
                        ->orderby('id', 'DESC')
                        ->first();

                    $address = $attendancedetail->address;
                    $diff_in_hours = 0;

                    $attendancedetail111count = DB::table('attendances')
                        ->whereDate('check_time', $attendances->date)
                        ->where('technician_id', $id)
                        ->orderby('id', 'ASC')
                        ->count();

                    if ($attendancedetail111count > 0) {
                        $attendancedetail111 = DB::table('attendances')
                            ->whereDate('check_time', $attendances->date)
                            ->where('technician_id', $id)
                            ->orderby('id', 'ASC')
                            ->get();

                        $checkindate = '';
                        $checkoutdate = '';
                        foreach ($attendancedetail111 as $row111) {
                            if ($row111->check_status == 'In') {
                                $checkindate = $row111->check_time;
                            } elseif ($row111->check_status == 'Out') {
                                $checkoutdate = $row111->check_time;
                            }

                            $checkin = \Carbon\Carbon::parse($checkindate)->format('Y-m-d');
                            $checkout = \Carbon\Carbon::parse($checkoutdate)->format('Y-m-d');
                            if ($checkin == $checkout) {
                                $start = new \Carbon\Carbon($checkindate);
                                $end = new \Carbon\Carbon($checkoutdate);

                                if ($end == date('Y-m-d H:i:s')) {
                                } else {
                                    $diff_in_hours111 = $start->diff($end)->format('%H');

                                    $diff_in_hours = $diff_in_hours111 + $diff_in_hours;
                                }
                            }
                        }
                    }
                } else {
                    $address = '';
                    $diff_in_hours = 0;
                }

                $monthsalary = $monthsalary = $technician->monthly_salary / 30;
                $perhoursalary = $perhoursalary = $monthsalary / 11;
                $total_salaries[] = $perhoursalary * $diff_in_hours;
            }
            $totalSalaries = array_sum($total_salaries);
        } else {
            $attendance = DB::table('attendances')->whereMonth('check_time', Carbon::now()->month)->where('technician_id', $request->id)
                ->select(DB::raw('DATE(check_time) as date'),)
                ->groupBy('date')
                ->get();
            $total_salaries = [];
            foreach ($attendance as $key => $attendances) {
                $attendancecountted = DB::table('attendances')
                    ->whereDate('check_time', $attendances->date)
                    ->where('technician_id', $id)
                    ->orderby('id', 'DESC')
                    ->count();

                if ($attendancecountted > 0) {
                    $attendancedetail = DB::table('attendances')
                        ->whereDate('check_time', $attendances->date)
                        ->where('technician_id', $id)
                        ->orderby('id', 'DESC')
                        ->first();

                    $address = $attendancedetail->address;
                    $diff_in_hours = 0;

                    $attendancedetail111count = DB::table('attendances')
                        ->whereDate('check_time', $attendances->date)
                        ->where('technician_id', $id)
                        ->orderby('id', 'ASC')
                        ->count();

                    if ($attendancedetail111count > 0) {
                        $attendancedetail111 = DB::table('attendances')
                            ->whereDate('check_time', $attendances->date)
                            ->where('technician_id', $id)
                            ->orderby('id', 'ASC')
                            ->get();

                        $checkindate = '';
                        $checkoutdate = '';
                        foreach ($attendancedetail111 as $row111) {
                            if ($row111->check_status == 'In') {
                                $checkindate = $row111->check_time;
                            } elseif ($row111->check_status == 'Out') {
                                $checkoutdate = $row111->check_time;
                            }

                            $checkin = \Carbon\Carbon::parse($checkindate)->format('Y-m-d');
                            $checkout = \Carbon\Carbon::parse($checkoutdate)->format('Y-m-d');
                            if ($checkin == $checkout) {
                                $start = new \Carbon\Carbon($checkindate);
                                $end = new \Carbon\Carbon($checkoutdate);

                                if ($end == date('Y-m-d H:i:s')) {
                                } else {
                                    $diff_in_hours111 = $start->diff($end)->format('%H');

                                    $diff_in_hours = $diff_in_hours111 + $diff_in_hours;
                                }
                            }
                        }
                    }
                } else {
                    $address = '';
                    $diff_in_hours = 0;
                }

                $monthsalary = $monthsalary = $technician->monthly_salary / 30;
                $perhoursalary = $perhoursalary = $monthsalary / 11;
                $total_salaries[] = $perhoursalary * $diff_in_hours;
            }
            $totalSalaries = array_sum($total_salaries);
        }


        return view('technician.view1', compact('attendance', 'technician', 'id','totalSalaries'));
    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function add_technician(Request $request)

    {

        $data = $request->all();


        $validated = $request->validate([
            'user_name' => 'unique:technicians',
            'mobile_no' => 'unique:technicians',
            'aadhar_no' => 'unique:technicians',
            'driving_license_no' => 'unique:technicians'
        ]);
        $technician = new Technician();
        if ($request->profile_image) {
            $filename = $this->resizeImage($request->profile_image, '/technician_images');
            $technician->profile_image =  $filename;
        }
        $technician->name = $request->name;
        $technician->user_name = $request->user_name;
        $technician->mobile_no = $request->mobile_no;
        $technician->aadhar_no = $request->aadhar_no;
        $technician->password = Hash::make($request->input('password'));
        $technician->dob = $request->dob;
        $technician->doj = $request->doj;
        $technician->remember_token = 'N/A';
        $technician->driving_license_no = $request->driving_license_no;
        $technician->monthly_salary = $request->monthly_salary;
        $technician->address = $request->address;
        $technician->save();
        return redirect()->route('technician');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $request->validate([

            'name'                  => 'required',

            'mobile_no'             => 'required',

            'user_name'             => 'required',

            'aadhar_no'             => 'required',

            'dob'                   => 'required',

            'doj'                   => 'required',

            'driving_license_no'    => 'required',

            'monthly_salary'        => 'required',

            'password_confirmation' => 'same:password',

        ]);
        $technician = Technician::where('id', $request->technician_id)->first();

        if ($request->profile_image) {

            // if($technician->profile_image){

            //     $publicPath = public_path('technician_images/'.$technician->profile_image);

            //     if($publicPath){

            //         unlink($publicPath);

            //     }

            //   }

            $filename = $this->resizeImage($request->profile_image, '/technician_images');
            $technician->profile_image =  $filename;
        }
        $technician->name = $request->name;
        $technician->user_name = $request->user_name;
        $technician->mobile_no = $request->mobile_no;
        $technician->aadhar_no = $request->aadhar_no;
        if ($request->input('password') !== null) {
            $technician->password = Hash::make($request->input('password'));
        }
        $technician->dob = $request->dob;
        $technician->doj = $request->doj;
        $technician->driving_license_no = $request->driving_license_no;
        $technician->monthly_salary = $request->monthly_salary;
        $technician->address = $request->address;
        $technician->save();
        return redirect()->route('technician');
    }





    /**

     * Display the specified resource.

     *

     * @param  technician  $technician

     * @return \Illuminate\Http\Response

     */

    public function show(technician $technician)

    {



        return view('technician.show-technician', compact('technician'));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  technician  $technician

     * @return \Illuminate\Http\Response

     */

    public function editProfile(Request $request)
    {
        $technician = Technician::where('id', $request->id)->first();
        return view('technician.edit', compact('technician'));
    }

    public function destroy($id)
    {

        // Logic to delete the technician with the given ID
        // Example:
        $technician = Technician::findOrFail($id);
        $technician->delete();
        // Redirect back or to a specific page

        return redirect()->route('technician.index')->with('success', 'Technician deleted successfully.');
    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  technician  $technician

     * @return \Illuminate\Http\Response

     */

    // public function update(Request $request, technician $technician)

    // {

    //     $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $technician->email);

    //     $ipAddress = new CaptureIpTrait();



    //     if ($emailCheck) {

    //         $validator = Validator::make($request->all(), [

    //             'name'          => 'required|max:255|unique:technician|alpha_dash',

    //             'email'         => 'email|max:255|unique:technician',

    //             'first_name'    => 'alpha_dash',

    //             'last_name'     => 'alpha_dash',

    //             'password'      => 'present|confirmed|min:6',

    //         ]);

    //     } else {

    //         $validator = Validator::make($request->all(), [

    //             'name'          => 'required|max:255|alpha_dash|unique:technician,name,'.$technician->id,

    //             'first_name'    => 'alpha_dash',

    //             'last_name'     => 'alpha_dash',

    //             'password'      => 'nullable|confirmed|min:6',

    //         ]);

    //     }



    //     if ($validator->fails()) {

    //         return back()->withErrors($validator)->withInput();

    //     }



    //     $technician->name = strip_tags($request->input('name'));

    //     $technician->first_name = strip_tags($request->input('first_name'));

    //     $technician->last_name = strip_tags($request->input('last_name'));



    //     if ($emailCheck) {

    //         $technician->email = $request->input('email');

    //     }



    //     if ($request->input('password') !== null) {

    //         $technician->password = Hash::make($request->input('password'));

    //     }



    //     $technicianRole = $request->input('role');

    //     if ($technicianRole !== null) {

    //         $technician->detachAllRoles();

    //         $technician->attachRole($technicianRole);

    //     }



    //     $technician->updated_ip_address = $ipAddress->getClientIp();



    //     switch ($technicianRole) {

    //         case 3:

    //             $technician->activated = 0;

    //             break;



    //         default:

    //             $technician->activated = 1;

    //             break;

    //     }



    //     $technician->save();



    //     return back()->with('success', trans('technicianmanagement.updateSuccess'));

    // }



    /**

     * Remove the specified resource from storage.

     *

     * @param  technician  $technician

     * @return \Illuminate\Http\Response

     */

    // public function destroy(technician $technician)

    // {

    //     $currenttechnician = Auth::technician();

    //     $ipAddress = new CaptureIpTrait();



    //     if ($technician->id !== $currenttechnician->id) {

    //         $technician->deleted_ip_address = $ipAddress->getClientIp();

    //         $technician->save();

    //         $technician->delete();



    //         return redirect('technician')->with('success', trans('technicianmanagement.deleteSuccess'));

    //     }



    //     return back()->with('error', trans('technicianmanagement.deleteSelfError'));

    // }



    /**

     * Method to search the technician.

     *

     * @param  Request  $request

     * @return \Illuminate\Http\Response

     */

    public function search(Request $request)

    {

        $searchTerm = $request->input('technician_search_box');

        $searchRules = [

            'technician_search_box' => 'required|string|max:255',

        ];

        $searchMessages = [

            'technician_search_box.required' => 'Search term is required',

            'technician_search_box.string'   => 'Search term has invalid characters',

            'technician_search_box.max'      => 'Search term has too many characters - 255 allowed',

        ];



        $validator = Validator::make($request->all(), $searchRules, $searchMessages);



        if ($validator->fails()) {

            return response()->json([

                json_encode($validator),

            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }



        $results = technician::where('id', 'like', $searchTerm . '%')

            ->orWhere('name', 'like', $searchTerm . '%')

            ->orWhere('email', 'like', $searchTerm . '%')->get();



        // Attach roles to results

        foreach ($results as $result) {

            $roles = [

                'roles' => $result->roles,

            ];

            $result->push($roles);
        }



        return response()->json([

            json_encode($results),

        ], Response::HTTP_OK);
    }





    // public function ajaxBtn(Request $request){



    //     $technician = Technician::where('id',$request->id)->first();



    //        return response()->json($technician);

    // }

}
