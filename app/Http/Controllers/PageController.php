<?php



namespace App\Http\Controllers;



use App\Models\AMC;

use App\Models\complaint;

use App\Models\job;

use App\Models\Technician;

use App\Models\User;

use App\Models\JobCategory;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\View\View;



class PageController extends Controller

{

    /**

     * Show specified view.

     *

     */

       public function dashboardOverview1()
    {
        $categoryCount = JobCategory::count();
        
          $totalTechnician = Technician::count();
          $totalAmc =DB::table('amcs')->count();
          $totalCustomers = User::where('type','3')->count();
        //   $pendingComplaintList = complaint::with('customer')->where('status','Processing')->paginate(5);
        //   $openComplaintList = complaint::with('customer')->where('status','Open')->orderby('created_at','DESC')->paginate(5);
        $openComplaintList = DB::table('complaints')
          ->join('users', 'complaints._customer_id', '=', 'users.id')
          ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
          ->select('complaints.*', 'users.name', 'customer_details.location_type')
          ->where('complaints.status','=','Open')
          ->orderBy('id', 'DESC')
          ->paginate(5);
        //   $totalComplaints = complaint::count();
        //     foreach ($totalComplaints as $key => $row) {
        //         $i++;
        //         $getJobData = DB::table('jobs')
        //             ->where('complaint_id', $row->id)
        //             ->count();
        //         if ($getJobData == 0) {
        //             $countcomplaints
        //         }
        //     }
        $totalComplaints = 0;
        $complaints = DB::table('complaints')
            ->join('users', 'complaints._customer_id', '=', 'users.id')
            ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
            ->select('complaints.*', 'users.name', 'customer_details.location_type')
            ->where('complaints.status', '=', 'Open')
            ->get();
        
        foreach ($complaints as $key => $row) {
            $getJobData = DB::table('jobs')
                ->where('complaint_id', $row->id)
                ->count();
        
            if ($getJobData == 0) {
                $row->countdata = $getJobData;
                $totalComplaints++;
            }
        }

        $todayComplaints = 0;
        $tooocomplaints = DB::table('complaints')
            ->join('users', 'complaints._customer_id', '=', 'users.id')
            ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
            ->select('complaints.*', 'users.name', 'customer_details.location_type')
            ->whereDate('complaints.created_at', Carbon::today()->toDateString())
            ->where('complaints.status', '=', 'Open')
            ->get();
        
        foreach ($complaints as $key => $row) {
            $getJobData = DB::table('jobs')
                ->where('complaint_id', $row->id)
                ->count();
        
            if ($getJobData == 0) {
                $row->countdata = $getJobData;
                $todayComplaints++;
            }
        }
    
          $totalJob = job::count();
          $totalAssignJob = job::where('technician_id','!=','0')->count();

          $checkinCounts = DB::table('attendances')->select('technician_id', DB::raw('COUNT(*) as checkin_count'))->whereDate('check_time', Carbon::today()->toDateString())
         ->where('check_status', 'In')
         ->groupBy('technician_id')->get();

         $totalAbsent = DB::table('technicians as t')
         ->select('t.id', DB::raw('COUNT(a.technician_id) as absent_count'))
         ->leftJoin('attendances as a', function ($join) {
             $join->on('t.id', '=', 'a.technician_id')
                  ->whereDate('a.check_time', Carbon::today()->toDateString())->where('a.check_status','In');
         })
         ->whereNull('a.technician_id')
         ->groupBy('t.id')
         ->get();
         $totalAbsent = count($totalAbsent);

         $checkinCounts = count($checkinCounts);
          $totalHoldComplaints = complaint::where('status','Hold')->count();
          $totalCompleteComplaints = complaint::where('status','Close')->count();
          $openComplaintCount = complaint::where('status','Open')->count();
          $todayopenComplaintCount = complaint::where('status','Open')->whereDate('created_at', Carbon::today()->toDateString())->count();
          $todayassignComplaintCount = job::where('status','Assign')->whereDate('created_at', Carbon::today()->toDateString())->count();
          $totalassignComplaintCount = job::where('status','Assign')->count();

        //   dd($totalassignComplaintCount);
        //   dd($todayassignComplaintCount);
          $currentDate = date('Y-m-d');
          $thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));
              $totalUpCommingAMC = DB::table('amcs')
                  ->join('users', 'amcs._user_id', '=', 'users.id')
                  ->join('amc_visit', 'amc_visit._amc_id', '=', 'amcs.id')
                  ->select('users.name', 'amcs.*', 'amc_visit.*')
                  ->whereBetween('amc_visit.visit_date', [$currentDate, $thirtyDaysLater])->count();


                  $totalpendingamc = DB::table('amcs')
                  ->join('users', 'amcs._user_id', '=', 'users.id')
                  ->join('amc_visit', 'amc_visit._amc_id', '=', 'amcs.id')
                  ->select('users.name', 'amcs.*', 'amc_visit.*')
                  ->whereDate('amc_visit.visit_date','<', $currentDate)
                  ->count();

                  $todaytotalUpCommingAMC = DB::table('amcs')
                  ->join('users', 'amcs._user_id', '=', 'users.id')
                  ->join('amc_visit', 'amc_visit._amc_id', '=', 'amcs.id')
                  ->select('users.name', 'amcs.*', 'amc_visit.*')
                  ->whereDate('amc_visit.visit_date', Carbon::today()->toDateString())->count();

                  $todaytotalpendingamc = DB::table('amcs')
                  ->join('users', 'amcs._user_id', '=', 'users.id')
                  ->join('amc_visit', 'amc_visit._amc_id', '=', 'amcs.id')
                  ->select('users.name', 'amcs.*', 'amc_visit.*')
                  ->whereDate('amc_visit.visit_date', Carbon::today()->toDateString())
                  ->count();

                $jobs = DB::table('jobs')
                  ->join('users', 'jobs.customer_id', '=', 'users.id')
                  ->select('jobs.*', 'users.name')->where('jobs.status','Processing')->orderBy('jobs.id', 'DESC')->paginate(8);

        $pendingComplaintList = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Pending')->paginate(5);

        $completejob = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Complete')->count();

        $totalamc11 = DB::table('amcs')->count();
        $totaljobs11 = DB::table('jobs')->count();

        $pendingCompl = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Pending')->count();

        $todaypendingCompl = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Pending')->whereDate('jobs.created_at', Carbon::today()->toDateString())->count();

        $holdCompl = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Hold')->count();

        $todayholdCompl = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Hold')->whereDate('jobs.created_at', Carbon::today()->toDateString())->count();

        $ProcessCompl = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->select('jobs.*', 'users.name')->
        where('status','Processing')->count();

        $todayProcessCompl = DB::table('jobs')->join('users', 'jobs.customer_id', '=', 'users.id')->select('jobs.*', 'users.name')->where('status','Processing')->whereDate('jobs.created_at', Carbon::today()->toDateString())->count();

        // $acfitting = DB::table('jobs')->whereRaw('FIND_IN_SET("Ac Fitting/Re-Fetting", job_category)')->count();
        $category1 = JobCategory::find(25);
        $acfitting = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->where('jobs.job_category', 'LIKE', '%' . $category1->category . '%')
        ->where([['jobs.status','<>','Complete'],['jobs.status','<>','Reject']])
        ->select('jobs.*', 'users.name')
        ->count();

        $todayacfitting = DB::table('jobs')->whereRaw('FIND_IN_SET("Ac Fitting/Re-Fetting", job_category)')->whereDate('created_at', Carbon::today()->toDateString())->count();

        $category2 = JobCategory::find(8);
        // $copper = DB::table('jobs')->whereRaw('FIND_IN_SET("Copper piping", job_category)')->count();
        $copper = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->where('jobs.job_category', 'LIKE', '%' . $category2->category . '%')
        ->where([['jobs.status','<>','Complete'],['jobs.status','<>','Reject']])
        ->select('jobs.*', 'users.name')
        ->count();

        $todaycopper = DB::table('jobs')->whereRaw('FIND_IN_SET("Copper piping", job_category)')->whereDate('created_at', Carbon::today()->toDateString())->count();

        $category3 = JobCategory::find(10);
        // $acheck = DB::table('jobs')->whereRaw('FIND_IN_SET("AC Check", job_category)')->count();
        $acheck = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->where('jobs.job_category', 'LIKE', '%' . $category3->category . '%')
        ->where([['jobs.status','<>','Complete'],['jobs.status','<>','Reject']])
        ->select('jobs.*', 'users.name')
        ->count();
        $todayacheck = DB::table('jobs')->whereRaw('FIND_IN_SET("AC Check", job_category)')->whereDate('created_at', Carbon::today()->toDateString())->count();

        $category4 = JobCategory::find(23);
        $acservice = DB::table('jobs')->whereRaw('FIND_IN_SET("AC Service", job_category)')->count();

        $acservice = DB::table('jobs')
        ->join('users', 'jobs.customer_id', '=', 'users.id')
        ->where('jobs.job_category', 'LIKE', '%' . $category4->category . '%')
        ->where([['jobs.status','<>','Complete'],['jobs.status','<>','Reject']])
        ->select('jobs.*', 'users.name')
        ->count();
        
        $todayacservice = DB::table('jobs')->whereRaw('FIND_IN_SET("AC Service", job_category)')->whereDate('created_at', Carbon::today()->toDateString())->count();

        return view('pages/dashboard-overview-1',compact('totalAbsent','jobs','totalAmc','openComplaintCount','totalTechnician','totalCustomers','totalComplaints','totalJob','checkinCounts','totalAssignJob','totalHoldComplaints','totalCompleteComplaints','totalUpCommingAMC','totalpendingamc','pendingComplaintList','openComplaintList','categoryCount','completejob','totalamc11','totaljobs11','pendingCompl','holdCompl','ProcessCompl','acfitting','copper','acheck','acservice','todayacfitting','todaycopper','todayacheck','todayacservice','todayComplaints','todayProcessCompl','todayopenComplaintCount','todaypendingCompl','todayholdCompl','todaytotalUpCommingAMC','todaytotalpendingamc','todayassignComplaintCount','totalassignComplaintCount'));
    }


    public function changeCheckInCount(Request $request){



        $checkinCounts = DB::table('attendances')->select('technician_id', DB::raw('COUNT(*) as checkin_count'))->whereDate('check_time', $request->date)

        ->where('check_status', 'In')

        ->groupBy('technician_id')->get();



        $totalAbsent = DB::table('technicians as t')

        ->select('t.id', DB::raw('COUNT(a.technician_id) as absent_count'))

        ->leftJoin('attendances as a', function ($join) use($request){

            $join->on('t.id', '=', 'a.technician_id')

                 ->whereDate('a.check_time', $request->date)->where('a.check_status','In');

        })->whereNull('a.technician_id')->groupBy('t.id')->get();



        $responseData = [

            'checkinCounts' => count($checkinCounts),

            'totalAbsent' => count($totalAbsent),

            // Add more data as needed

        ];

        return response()->json($responseData);



    }

    /**

     * Show specified view.

     *

     */

    public function dashboardOverview2(): View

    {

        return view('pages/dashboard-overview-2');

    }



    /**

     * Show specified view.

     *

     */

    public function dashboardOverview3(): View

    {

        return view('pages/dashboard-overview-3');

    }



    /**

     * Show specified view.

     *

     */

    public function dashboardOverview4(): View

    {

        return view('pages/dashboard-overview-4');

    }



    /**

     * Show specified view.

     *

     */

    public function inbox(): View

    {

        return view('pages/inbox');

    }



    /**

     * Show specified view.

     *

     */

    public function categories(): View

    {

        return view('pages/categories');

    }



    /**

     * Show specified view.

     *

     */

    public function addProduct(): View

    {

        return view('pages/add-product');

    }



    /**

     * Show specified view.

     *

     */

    public function productList(): View

    {

        return view('pages/product-list');

    }



    /**

     * Show specified view.

     *

     */

    public function productGrid(): View

    {

        return view('pages/product-grid');

    }



    /**

     * Show specified view.

     *

     */

    public function transactionList(): View

    {

        return view('pages/transaction-list');

    }



    /**

     * Show specified view.

     *

     */

    public function transactionDetail(): View

    {

        return view('pages/transaction-detail');

    }



    /**

     * Show specified view.

     *

     */

    public function sellerList(): View

    {

        return view('pages/seller-list');

    }



    /**

     * Show specified view.

     *

     */

    public function sellerDetail(): View

    {

        return view('pages/seller-detail');

    }



    /**

     * Show specified view.

     *

     */

    public function reviews(): View

    {

        return view('pages/reviews');

    }



    /**

     * Show specified view.

     *

     */

    public function fileManager(): View

    {

        return view('pages/file-manager');

    }



    /**

     * Show specified view.

     *

     */

    public function pointOfSale(): View

    {

        return view('pages/point-of-sale');

    }



    /**

     * Show specified view.

     *

     */

    public function chat(): View

    {

        return view('pages/chat');

    }



    /**

     * Show specified view.

     *

     */

    public function post(): View

    {

        return view('pages/post');

    }



    /**

     * Show specified view.

     *

     */

    public function calendar(): View

    {

        return view('pages/calendar');

    }



    /**

     * Show specified view.

     *

     */

    public function crudDataList(): View

    {

        return view('pages/crud-data-list');

    }



    /**

     * Show specified view.

     *

     */

    public function crudForm(): View

    {

        return view('pages/crud-form');

    }



    /**

     * Show specified view.

     *

     */

    public function usersLayout1(): View

    {

        return view('pages/users-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function usersLayout2(): View

    {

        return view('pages/users-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function usersLayout3(): View

    {

        return view('pages/users-layout-3');

    }



    /**

     * Show specified view.

     *

     */

    public function profileOverview1(): View

    {

        return view('pages/profile-overview-1');

    }



    /**

     * Show specified view.

     *

     */

    public function profileOverview2(): View

    {

        return view('pages/profile-overview-2');

    }



    /**

     * Show specified view.

     *

     */

    public function profileOverview3(): View

    {

        return view('pages/profile-overview-3');

    }



    /**

     * Show specified view.

     *

     */

    public function wizardLayout1(): View

    {

        return view('pages/wizard-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function wizardLayout2(): View

    {

        return view('pages/wizard-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function wizardLayout3(): View

    {

        return view('pages/wizard-layout-3');

    }



    /**

     * Show specified view.

     *

     */

    public function blogLayout1(): View

    {

        return view('pages/blog-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function blogLayout2(): View

    {

        return view('pages/blog-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function blogLayout3(): View

    {

        return view('pages/blog-layout-3');

    }



    /**

     * Show specified view.

     *

     */

    public function pricingLayout1(): View

    {

        return view('pages/pricing-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function pricingLayout2(): View

    {

        return view('pages/pricing-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function invoiceLayout1(): View

    {

        return view('pages/invoice-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function invoiceLayout2(): View

    {

        return view('pages/invoice-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function faqLayout1(): View

    {

        return view('pages/faq-layout-1');

    }



    /**

     * Show specified view.

     *

     */

    public function faqLayout2(): View

    {

        return view('pages/faq-layout-2');

    }



    /**

     * Show specified view.

     *

     */

    public function faqLayout3(): View

    {

        return view('pages/faq-layout-3');

    }



    /**

     * Show specified view.

     *

     */

    public function login(): View

    {

        return view('pages/login');

    }



    /**

     * Show specified view.

     *

     */

    public function register(): View

    {

        return view('pages/register');

    }



    /**

     * Show specified view.

     *

     */

    public function errorPage(): View

    {

        return view('pages/error-page');

    }



    /**

     * Show specified view.

     *

     */

    public function updateProfile(): View

    {

        return view('pages/update-profile');

    }



    /**

     * Show specified view.

     *

     */

    public function changePassword(): View

    {

        return view('pages/change-password');

    }



    /**

     * Show specified view.

     *

     */

    public function regularTable(): View

    {

        return view('pages/regular-table');

    }



    /**

     * Show specified view.

     *

     */

    public function tabulator(): View

    {

        return view('pages/tabulator');

    }



    /**

     * Show specified view.

     *

     */

    public function modal(): View

    {

        return view('pages/modal');

    }



    /**

     * Show specified view.

     *

     */

    public function slideOver(): View

    {

        return view('pages/slide-over');

    }



    /**

     * Show specified view.

     *

     */

    public function notification(): View

    {

        return view('pages/notification');

    }



    /**

     * Show specified view.

     *

     */

    public function tab(): View

    {

        return view('pages/tab');

    }



    /**

     * Show specified view.

     *

     */

    public function accordion(): View

    {

        return view('pages/accordion');

    }



    /**

     * Show specified view.

     *

     */

    public function button(): View

    {

        return view('pages/button');

    }



    /**

     * Show specified view.

     *

     */

    public function alert(): View

    {

        return view('pages/alert');

    }



    /**

     * Show specified view.

     *

     */

    public function progressBar(): View

    {

        return view('pages/progress-bar');

    }



    /**

     * Show specified view.

     *

     */

    public function tooltip(): View

    {

        return view('pages/tooltip');

    }



    /**

     * Show specified view.

     *

     */

    public function dropdown(): View

    {

        return view('pages/dropdown');

    }



    /**

     * Show specified view.

     *

     */

    public function typography(): View

    {

        return view('pages/typography');

    }



    /**

     * Show specified view.

     *

     */

    public function icon(): View

    {

        return view('pages/icon');

    }



    /**

     * Show specified view.

     *

     */

    public function loadingIcon(): View

    {

        return view('pages/loading-icon');

    }



    /**

     * Show specified view.

     *

     */

    public function regularForm(): View

    {

        return view('pages/regular-form');

    }



    /**

     * Show specified view.

     *

     */

    public function datepicker(): View

    {

        return view('pages/datepicker');

    }



    /**

     * Show specified view.

     *

     */

    public function tomSelect(): View

    {

        return view('pages/tom-select');

    }



    /**

     * Show specified view.

     *

     */

    public function fileUpload(): View

    {

        return view('pages/file-upload');

    }



    /**

     * Show specified view.

     *

     */

    public function wysiwygEditorClassic(): View

    {

        return view('pages/wysiwyg-editor-classic');

    }



    /**

     * Show specified view.

     *

     */

    public function wysiwygEditorInline(): View

    {

        return view('pages/wysiwyg-editor-inline');

    }



    /**

     * Show specified view.

     *

     */

    public function wysiwygEditorBalloon(): View

    {

        return view('pages/wysiwyg-editor-balloon');

    }



    /**

     * Show specified view.

     *

     */

    public function wysiwygEditorBalloonBlock(): View

    {

        return view('pages/wysiwyg-editor-balloon-block');

    }



    /**

     * Show specified view.

     *

     */

    public function wysiwygEditorDocument(): View

    {

        return view('pages/wysiwyg-editor-document');

    }



    /**

     * Show specified view.

     *

     */

    public function validation(): View

    {

        return view('pages/validation');

    }



    /**

     * Show specified view.

     *

     */

    public function chart(): View

    {

        return view('pages/chart');

    }



    /**

     * Show specified view.

     *

     */

    public function slider(): View

    {

        return view('pages/slider');

    }



    /**

     * Show specified view.

     *

     */

    public function imageZoom(): View

    {

        return view('pages/image-zoom');

    }

}

