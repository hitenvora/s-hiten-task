@extends('../layouts/side-menu')



@section('subhead')
    <title>Dashboard - Sk Backend</title>
@endsection



@section('subcontent')
    <style>
        .w-full {
            font-size: 12px !important;
        }

        .fontsi {
            width: 19px;
            height: 16px;
            margin-right: 4px;
        }

        .fontsi11 {
            width: 16px;
            height: 28px;
            margin-right: 4px;
        }

        .cd-popup {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s 0s, visibility 0s 0.3s;
        }

        .cd-popup.is-visible {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.3s 0s, visibility 0s 0s;
        }

        .cd-popup-container {
            transform: translateY(-40px);
            transition-property: transform;
            transition-duration: 0.3s;
        }

        .is-visible .cd-popup-container {
            transform: translateY(0);
        }

        .before\:bg-slate-200\/70:before {
            content: var(--tw-content);
            background-color: #ffffffb3;
        }
    </style>
    <style>
        .ui-widgets {
            position: relative;
            display: inline-block;
            width: 7rem;
            height: 7rem;
            border-radius: 9rem;
            margin: 0px;
            border: 9px solid palegreen;
            box-shadow: inset 0 0 7px grey;
            border-left-color: #fb023f;
            border-top-color: #fb023f;
            border-right-color: #ff9800;
            border-bottom-color: #fb023f;
            text-align: center;
            box-sizing: border-box;
        }

        /* Apply css properties to the second
                                    child of ui-widgets class */
        .ui-widgets:nth-child(2) {
            border-top-color: chartreuse;
            border-right-color: white;
            border-left-color: palegreen;
            border-bottom-color: white;
        }

        /* Apply css properties to ui-widgets
                                   class and ui-values class */
        .ui-widgets .ui-values {
            top: 30px;
            position: absolute;
            left: 10px;
            right: 0;
            font-weight: 700;
            font-size: 14px;
        }

        /*  Apply css properties to ui-widgets
                                class and ui-labels class */
        .ui-widgets .ui-labels {
            left: 0;
            bottom: -16px;
            text-shadow: 0 0 4px grey;
            color: black;
            position: absolute;
            width: 100%;
            font-size: 16px;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maps.google.com/maps/api/js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&sensor=true"
        type="text/javascript"></script>

    <style type="text/css">
        #mymap {
            border: 1px solid red;
            width: 800px;
            height: 500px;
        }
    </style>



    <div class="grid grid-cols-15 gap-6">
        <div class="col-span-12 mt-2 sm:col-span-12 lg:col-span-12 xl:col-span-12">
            <div class="col-span-12 mt-2 sm:col-span-12 lg:col-span-12 xl:col-span-12">
                <h2 class="mr-5 truncate text-lg font-medium" style="margin-bottom: 15px;">Dashboard</h2>
            </div>
            <div class="relative">
                <div class="grid grid-cols-12 gap-6">
                    <div class="z-20 col-span-12 xl:col-span-9 2xl:col-span-9" style="background: white;">
                        <div class="grid grid-cols-12 mb-3 intro-y sm:gap-10">
                            <div
                                class="relative col-span-12 py-6 text-center sm:col-span-6 sm:pl-5 sm:text-left md:col-span-4 md:pl-0 lg:pl-5">
                                <div class="flex items-center justify-center text-base leading-3 mt-14 text-slate-600 dark:text-slate-300 sm:justify-start 2xl:mt-24 2xl:text-lg"
                                    style="display: contents;">
                                    <div style="border-radius: 10px;padding: 15px 10px; background: #164e63;">
                                        <a href="{{ route('list.complaint') }}">
                                            <div style="display:flex;">
                                                <div><x-base.lucide class="h-10 w-10 text-warning fouzal" icon="ShoppingBag"
                                                        style="color: white; font-weight: 400; height: 36px; margin-top: 10px;" />
                                                </div>
                                                <div
                                                    style="font-size:21px; line-height: 30px; padding-left:15px;color:white;">
                                                    Total Complain {{ $totalComplaints }}</div>

                                            </div>
                                        </a>
                                        <!--<div class="relative mt-8 pl-4 text-3xl font-large"-->
                                        <!--    style="    color: white;font-weight: 500; margin-top: 10px; margin-bottom: 8px;">-->

                                        <!--</div>-->
                                    </div>
                                    @php
                                        $totalCustomer = DB::table('users')
                                            ->where('deleted_at', null)
                                            ->where('type', 3)
                                            ->orderBy('id', 'DESC')
                                            ->count();
                                    @endphp
                                    <div
                                        style="border-radius: 10px;padding: 15px 10px; background: #164e63;margin-top: 10px;">
                                        <a href="{{ route('customer.list') }}">
                                            <div style="display:flex;">
                                                <div><x-base.lucide class="h-10 w-10 text-warning fouzal" icon="User"
                                                        style="color: white; font-weight: 400; height: 36px; margin-top: 10px;" />
                                                </div>
                                                <div
                                                    style="font-size:21px; line-height: 30px; padding-left:15px;color:white;">
                                                    Total Customer {{ $totalCustomer }}</div>

                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <x-base.menu class="mt-14 w-44 2xl:mt-24 2xl:w-52" placement="bottom-start"
                                    style="width: 100%; margin-top:25px;">
                                    <a href="{{ route('create.complaint') }}"
                                        class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-danger focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                        style=" width: 100%;background: #f59e0b;">Create Complain</a>

                                    <a href="{{ route('create.customer.form') }}"
                                        class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-warning focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-info border-warning text-white dark:border-warning mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                        style=" width: 100%;background: #164e63">Create Customer</a>

                                    <a href="{{ route('create.amc.form') }}"
                                        class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-warning focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-info border-warning text-white dark:border-warning mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                        style=" width: 100%;background: #f59e0b;">Create AMC</a>

                                    <a href="{{ route('complainreport') }}"
                                        class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                        style=" width: 100%;background: #164e63">Complain Reports</a>


                                </x-base.menu>
                            </div>
                            <div class="col-span-12 row-start-2 px-10 py-6 -mx-5 border-t border-black border-dashed border-opacity-10 sm:px-28 md:col-span-4 md:row-start-auto md:border-t-0 md:border-l md:border-r md:px-5"
                                style="padding-top: 32px;">
                                <div class="flex items-center justify-center text-base leading-3 mt-14 text-slate-600 dark:text-slate-300 sm:justify-start 2xl:mt-24 2xl:text-lg"
                                    style="display:contents;color: #164e63!important; font-weight:400;font-size: 24px;">
                                    Total AMC <label style="float:right;"> {{ $totalAmc }}</label>
                                </div>
                                <div class="mt-5 mb-3 2xl:flex">
                                    <div class="flex items-center justify-center sm:justify-start">
                                        <div class="relative pl-3 text-2xl font-medium leading-6 2xl:pl-4 2xl:text-3xl">

                                        </div>
                                    </div>
                                </div>
                                <div class="broder-slate-200 mt-2 border-b">
                                    <div class="-mb-1.5 -ml-2.5">
                                        <x-report-bar-chart height="h-[79px]" />
                                    </div>
                                </div>

                                <div class="mt-4 mb-2 flex border-b border-slate-200 pb-2 text-xs text-slate-500">
                                    <div style="color: #164e63; font-weight: 600;">AMC Page</div>
                                    <div class="ml-auto" style="color: #164e63; font-weight: 600;">Active Users</div>
                                </div>

                                <div class="mt-1.5 flex">
                                    <div style="color: #164e63;">Up Coming AMC</div>
                                    <div class="ml-auto" style="color: #164e63; font-weight: 600;">{{ $totalUpCommingAMC }}
                                    </div>
                                </div>

                                <div class="mt-1.5 flex">
                                    <div style="color: #164e63;">Pending AMC</div>
                                    <div class="ml-auto" style="color: #164e63; font-weight: 600;">{{ $totalpendingamc }}
                                    </div>
                                </div>

                                @php
                                    $getExpireDatacount = DB::table('amcs')
                                        ->leftJoin('customer_details', function ($join) {
                                            $join->on(
                                                DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'),
                                                '>',
                                                DB::raw('0'),
                                            );
                                        })
                                        ->leftJoin('users', 'amcs._user_id', '=', 'users.id')
                                        ->where('amcs.end_date', '<=', date('Y-m-d'))
                                        ->select(
                                            'amcs.*',
                                            'users.name',
                                            DB::raw(
                                                'GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type',
                                            ),
                                        )
                                        ->groupBy(
                                            'amcs.id',
                                            'amcs._user_id',
                                            'amcs._customer_details_id',
                                            'amcs.contract_type',
                                            'amcs.amc_type',
                                            'amcs.start_date',
                                            'amcs.end_date',
                                            'amcs.deleted_at',
                                            'amcs.created_at',
                                            'amcs.updated_at',
                                            'amcs.contract_amount',
                                            'users.name',
                                        )
                                        ->count();

                                    $todaygetExpireDatacount = DB::table('amcs')
                                        ->leftJoin('customer_details', function ($join) {
                                            $join->on(
                                                DB::raw('FIND_IN_SET(customer_details.id, amcs._customer_details_id)'),
                                                '>',
                                                DB::raw('0'),
                                            );
                                        })
                                        ->leftJoin('users', 'amcs._user_id', '=', 'users.id')
                                        ->where('amcs.end_date', '<=', date('Y-m-d'))
                                        ->select(
                                            'amcs.*',
                                            'users.name',
                                            DB::raw(
                                                'GROUP_CONCAT(customer_details.location_type SEPARATOR ",") as location_type',
                                            ),
                                        )
                                        ->groupBy(
                                            'amcs.id',
                                            'amcs._user_id',
                                            'amcs._customer_details_id',
                                            'amcs.contract_type',
                                            'amcs.amc_type',
                                            'amcs.start_date',
                                            'amcs.end_date',
                                            'amcs.deleted_at',
                                            'amcs.created_at',
                                            'amcs.updated_at',
                                            'amcs.contract_amount',
                                            'users.name',
                                        )
                                        ->whereDate('amcs.created_at', \Carbon\Carbon::today()->toDateString())
                                        ->count();

                                @endphp

                                <div class="mt-1.5 flex">
                                    <div style="color: #164e63;">Expire AMC</div>
                                    <div class="ml-auto" style="color: #164e63 font-weight: 600;">{{ $getExpireDatacount }}
                                    </div>
                                </div>

                                <x-base.button class="mt-4 w-full border-dashed px-2 py-1" variant="outline-secondary"
                                    style="font-size: 14px !important; padding: 8px; border-color: #164e63;  color: #164e63;  margin-bottom: 10px;">
                                    <a href="{{ route('list.amc') }}">Total AMC</a>
                                </x-base.button>

                                <a href="{{ route('amcreport') }}"
                                    class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                    style=" width: 100%;">AMC Reports</a>
                            </div>
                            <x-base.tab.group
                                class="col-span-12 py-6 pl-4 -ml-4 border-t border-l border-black border-dashed border-opacity-10 sm:col-span-6 sm:border-t-0 md:col-span-4 md:ml-0 md:border-l-0 md:pl-0">
                                <x-base.tab.list class="mx-auto w-4/5 rounded-md" variant="pills">
                                    <x-base.tab id="active-users-tab" selected>
                                        <x-base.tab.button as="button"
                                            style="display: contents; color: #164e63!important; font-weight: 500; font-size: 17px;">
                                            Attendance
                                        </x-base.tab.button>
                                    </x-base.tab>
                                </x-base.tab.list>
                                <x-base.tab.panels class="mt-6" style="margin-top: 5px;">
                                    <x-base.tab.panel id="active-users" selected>
                                        <div class="relative">
                                            <div id="donutchart" style="width: 100%; text-align: center;"></div>
                                            <!-- <x-report-donut-chart

                                                                            class="mt-3"

                                                                            height="h-[208px]"

                                                                        />

                                                                        <div

                                                                            class="absolute top-0 left-0 flex h-full w-full flex-col items-center justify-center">

                                                                            <div class="text-2xl font-medium">{{ $totalTechnician }}</div>

                                                                            <div class="mt-0.5 text-slate-500">Active Users</div>

                                                                        </div> -->

                                        </div>

                                        <div class="mx-auto w-52 sm:w-auto">

                                            <div class="flex items-center" style="padding-right:10px;">

                                                <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>

                                                <span class="truncate">Total Technicians</span>

                                                <span class="ml-auto font-medium">{{ $totalTechnician }}</span>

                                            </div>

                                            <div class="mt-4 flex items-center"
                                                style="padding-right:10px;margin-top: 8px;">

                                                <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>

                                                <span class="truncate">Total Check-In</span>

                                                <span class="ml-auto font-medium"><span
                                                        id="totalchheckin">{{ $checkinCounts }}</span></span>

                                            </div>

                                            <div class="mt-4 flex items-center"
                                                style="padding-right:10px;margin-top: 8px;">

                                                <div class="mr-3 h-2 w-2 rounded-full bg-warning"></div>

                                                <span class="truncate">Total Check-Out</span>

                                                <span class="ml-auto font-medium"><span id="totalAbsent">
                                                        {{ $totalAbsent }}</span></span>

                                            </div>

                                        </div>

                                    </x-base.tab.panel>

                                </x-base.tab.panels>

                                <a href="{{ route('technicianreport') }}"
                                    class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                                    style=" width: 90%;margin-top:15px;">Technician Reports</a>
                            </x-base.tab.group>
                        </div>
                    </div>


                    @php
                        $sumcategory = $acfitting + $copper + $acheck + $acservice;
                        if ($sumcategory == 0) {
                            $acfittingchart1 = 0;
                            $copperchart1 = 0;
                            $acheckchart1 = 0;
                            $acservicechart1 = 0;
                        } else {
                            $acfittingchart1 = ($acfitting / $sumcategory) * 100;
                            $copperchart1 = ($copper / $sumcategory) * 100;
                            $acheckchart1 = ($acheck / $sumcategory) * 100;
                            $acservicechart1 = ($acservice / $sumcategory) * 100;
                        }

                        $acfittingchart = round($acfittingchart1);
                        $copperchart = round($copperchart1);
                        $acheckchart = round($acheckchart1);
                        $acservicechart = round($acservicechart1);
                    @endphp

                    <div class="col-span-12 mt-8 grid grid-cols-12 gap-6">
                        @php
                            $jobCategy1 = DB::table('job_categories')->where('id', 25)->first();
                            $jobCategy2 = DB::table('job_categories')->where('id', 8)->first();
                            $jobCategy3 = DB::table('job_categories')->where('id', 10)->first();
                            $jobCategy4 = DB::table('job_categories')->where('id', 23)->first();

                            $jobCategy1jobs = DB::table('jobs')
                                ->join('users', 'jobs.customer_id', '=', 'users.id')
                                ->where('jobs.job_category', 'LIKE', '%' . $jobCategy1->category . '%')
                                ->where([['jobs.status', '<>', 'Complete'], ['jobs.status', '<>', 'Reject']])
                                ->select('jobs.*', 'users.name')
                                ->count();

                            $jobCategy2jobs = DB::table('jobs')
                                ->join('users', 'jobs.customer_id', '=', 'users.id')
                                ->where('jobs.job_category', 'LIKE', '%' . $jobCategy2->category . '%')
                                ->where([['jobs.status', '<>', 'Complete'], ['jobs.status', '<>', 'Reject']])
                                ->select('jobs.*', 'users.name')
                                ->count();

                            $jobCategy3jobs = DB::table('jobs')
                                ->join('users', 'jobs.customer_id', '=', 'users.id')
                                ->where('jobs.job_category', 'LIKE', '%' . $jobCategy3->category . '%')
                                ->where([['jobs.status', '<>', 'Complete'], ['jobs.status', '<>', 'Reject']])
                                ->select('jobs.*', 'users.name')
                                ->count();

                            $jobCategy4jobs = DB::table('jobs')
                                ->join('users', 'jobs.customer_id', '=', 'users.id')
                                ->where('jobs.job_category', 'LIKE', '%' . $jobCategy4->category . '%')
                                ->where([['jobs.status', '<>', 'Complete'], ['jobs.status', '<>', 'Reject']])
                                ->select('jobs.*', 'users.name')
                                ->count();
                        @endphp
                        <div class="intro-y col-span-5">
                            <div class="box p-5">
                                <a href="{{ route('categorywiseJobList.list', $jobCategy1->id) }}">
                                    <div class="flex items-center">
                                        <div class="w-2/4 flex-none">
                                            <div class="truncate text-lg font-medium"> {{ $jobCategy1->category }}</div>
                                            <div class="mt-1 text-slate-500">{{ $jobCategy1jobs }}</div>
                                        </div>
                                        <div class="relative ml-auto flex-none">
                                            <!-- <div class="w-[90px] h-[90px]">
                                                                            <canvas class="chart report-donut-chart-1 report-donut-chart-1" style="display: block; box-sizing: border-box; height: 90px; width: 90px;" width="135" height="135"></canvas>
                
                                                                        </div>
                
                                                                        <div class="absolute top-0 left-0 flex h-full w-full items-center justify-center font-medium">
                                                                        {{ $acfitting }}%
                                                                        </div> -->
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                                            <canvas id="myChart"
                                                style="font-size:14px;vertical-align: top;margin: 0px !important;paddibng:0px !important; width:100px;"
                                                options={options}></canvas>
                                            <script>
                                                const originalDoughnutDraw = Chart.controllers.doughnut.prototype.draw;

                                                Chart.helpers.extend(Chart.controllers.doughnut.prototype, {
                                                    draw: function() {
                                                        const chart = this.chart;
                                                        const {
                                                            width,
                                                            height,
                                                            ctx,
                                                            config
                                                        } = chart.chart;

                                                        const {
                                                            datasets
                                                        } = config.data;

                                                        const dataset = datasets[0];
                                                        const datasetData = dataset.data;
                                                        const completed = datasetData[0];
                                                        const text = `${completed}%`;
                                                        let x, y, mid;

                                                        originalDoughnutDraw.apply(this, arguments);

                                                        const fontSize = (height / 100).toFixed(2);
                                                        ctx.font = fontSize + "em Lato, sans-serif";
                                                        ctx.textBaseline = "top";

                                                        x = Math.round((width - ctx.measureText(text).width) / 2);
                                                        y = (height / 2.2) - fontSize;
                                                        ctx.fillStyle = "#000000"
                                                        ctx.fillText(text, x, y);
                                                        mid = x + ctx.measureText(text).width / 2;
                                                    }
                                                });


                                                var context = document.getElementById('myChart').getContext('2d');
                                                var percent_value = {{ $acfittingchart }};
                                                var chart = new Chart(context, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['', ''],
                                                        datasets: [{
                                                            label: 'First dataset',
                                                            data: [percent_value, 100 - percent_value],
                                                            backgroundColor: ['#f59e0b', '#164e63'],
                                                            borderWidth: 2,
                                                            fontColor: 'rgb(255, 0, 0)',
                                                            fontSize: 25
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        title: {
                                                            display: false,
                                                            position: "top",
                                                            fontStyle: "bold",
                                                            fullWidth: false,
                                                            padding: 0
                                                        },
                                                        pieHole: 0.2,
                                                        aspectRatio: 1,
                                                        cutoutPercentage: 80,
                                                        legend: {
                                                            display: false,
                                                            position: "top",
                                                            fullWidth: false,
                                                            labels: {
                                                                display: false,
                                                                usePointStyle: true,
                                                                fontSize: 24,
                                                                fontStyle: "bold"
                                                            }

                                                        }
                                                    }
                                                });
                                            </script>
                                            <!-- <div class="container1">
                                                                        <div class="ui-widgets">
                                                                            <div class="ui-values">85%</div>
                                                                            <div class="ui-labels">Java</div>
                                                                        </div>
                                                                        </div> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="intro-y col-span-4">
                            <div class="box p-5">
                                <a href="{{ route('categorywiseJobList.list', $jobCategy2->id) }}">
                                    <div class="flex items-center">
                                        <div class="w-2/4 flex-none">
                                            <div class="truncate text-lg font-medium">{{ $jobCategy2->category }}</div>
                                            <div class="mt-1 text-slate-500">{{ $jobCategy2jobs }}</div>
                                        </div>
                                        <div class="relative ml-auto flex-none">
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                                            <canvas id="myChart1"
                                                style="font-size:14px;vertical-align: top;margin: 0px !important;paddibng:0px !important; width:100px;"
                                                options={options}></canvas>
                                            <script>
                                                const originalDoughnutDraw1 = Chart.controllers.doughnut.prototype.draw;
                                                Chart.helpers.extend(Chart.controllers.doughnut.prototype, {
                                                    draw: function() {
                                                        const chart = this.chart;
                                                        const {
                                                            width,
                                                            height,
                                                            ctx,
                                                            config
                                                        } = chart.chart;

                                                        const {
                                                            datasets
                                                        } = config.data;

                                                        const dataset = datasets[0];
                                                        const datasetData = dataset.data;
                                                        const completed = datasetData[0];
                                                        const text = `${completed}%`;
                                                        let x, y, mid;

                                                        originalDoughnutDraw1.apply(this, arguments);

                                                        const fontSize = (height / 100).toFixed(2);
                                                        ctx.font = fontSize + "em Lato, sans-serif";
                                                        ctx.textBaseline = "top";

                                                        x = Math.round((width - ctx.measureText(text).width) / 2);
                                                        y = (height / 2.2) - fontSize;
                                                        ctx.fillStyle = "#000000"
                                                        ctx.fillText(text, x, y);
                                                        mid = x + ctx.measureText(text).width / 2;
                                                    }
                                                });
                                                var context = document.getElementById('myChart1').getContext('2d');
                                                var percent_value = {{ $copperchart }};
                                                var chart = new Chart(context, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['', ''],
                                                        datasets: [{
                                                            label: 'First dataset',
                                                            data: [percent_value, 100 - percent_value],
                                                            backgroundColor: ['#f59e0b', '#164e63'],
                                                            borderWidth: 2,
                                                            fontColor: 'rgb(255, 0, 0)',
                                                            fontSize: 25
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        title: {
                                                            display: false,
                                                            position: "top",
                                                            fontStyle: "bold",
                                                            fullWidth: false,
                                                            padding: 0
                                                        },
                                                        pieHole: 0.2,
                                                        aspectRatio: 1,
                                                        cutoutPercentage: 80,
                                                        legend: {
                                                            display: false,
                                                            position: "top",
                                                            fullWidth: false,
                                                            labels: {
                                                                display: false,
                                                                usePointStyle: true,
                                                                fontSize: 24,
                                                                fontStyle: "bold"
                                                            }
                                                        }
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="intro-y col-span-5">
                            <div class="box p-5">
                                <a href="{{ route('categorywiseJobList.list', $jobCategy3->id) }}">
                                    <div class="flex items-center">
                                        <div class="w-2/4 flex-none">
                                            <div class="truncate text-lg font-medium">{{ $jobCategy3->category }}</div>
                                            <div class="mt-1 text-slate-500">{{ $jobCategy3jobs }}</div>
                                        </div>
                                        <div class="relative ml-auto flex-none">
                                            <!-- <div class="w-[90px] h-[90px]">
                                                                            <canvas class="chart report-donut-chart-1 report-donut-chart-1" style="display: block; box-sizing: border-box; height: 90px; width: 90px;" width="135" height="135"></canvas>
                
                                                                        </div>
                
                                                                        <div class="absolute top-0 left-0 flex h-full w-full items-center justify-center font-medium">
                                                                        {{ $acheck }}%
                                                                        </div> -->
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                                            <canvas id="myChart2"
                                                style="font-size:14px;vertical-align: top;margin: 0px !important;paddibng:0px !important; width:100px;"
                                                options={options}></canvas>
                                            <script>
                                                const originalDoughnutDraw2 = Chart.controllers.doughnut.prototype.draw;

                                                Chart.helpers.extend(Chart.controllers.doughnut.prototype, {
                                                    draw: function() {
                                                        const chart = this.chart;
                                                        const {
                                                            width,
                                                            height,
                                                            ctx,
                                                            config
                                                        } = chart.chart;

                                                        const {
                                                            datasets
                                                        } = config.data;

                                                        const dataset = datasets[0];
                                                        const datasetData = dataset.data;
                                                        const completed = datasetData[0];
                                                        const text = `${completed}%`;
                                                        let x, y, mid;

                                                        originalDoughnutDraw2.apply(this, arguments);

                                                        const fontSize = (height / 100).toFixed(2);
                                                        ctx.font = fontSize + "em Lato, sans-serif";
                                                        ctx.textBaseline = "top";

                                                        x = Math.round((width - ctx.measureText(text).width) / 2);
                                                        y = (height / 2.2) - fontSize;
                                                        ctx.fillStyle = "#000000"
                                                        ctx.fillText(text, x, y);
                                                        mid = x + ctx.measureText(text).width / 2;
                                                    }
                                                });


                                                var context = document.getElementById('myChart2').getContext('2d');
                                                var percent_value = {{ $acheckchart }};
                                                var chart = new Chart(context, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['', ''],
                                                        datasets: [{
                                                            label: 'First dataset',
                                                            data: [percent_value, 100 - percent_value],
                                                            backgroundColor: ['#f59e0b', '#164e63'],
                                                            borderWidth: 2,
                                                            fontColor: 'rgb(255, 0, 0)',
                                                            fontSize: 25
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        title: {
                                                            display: false,
                                                            position: "top",
                                                            fontStyle: "bold",
                                                            fullWidth: false,
                                                            padding: 0
                                                        },
                                                        pieHole: 0.2,
                                                        aspectRatio: 1,
                                                        cutoutPercentage: 80,
                                                        legend: {
                                                            display: false,
                                                            position: "top",
                                                            fullWidth: false,
                                                            labels: {
                                                                display: false,
                                                                usePointStyle: true,
                                                                fontSize: 24,
                                                                fontStyle: "bold"
                                                            }

                                                        }
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="intro-y col-span-4">
                            <div class="box p-5">
                                <a href="{{ route('categorywiseJobList.list', $jobCategy4->id) }}">
                                    <div class="flex items-center">
                                        <div class="w-2/4 flex-none">
                                            <div class="truncate text-lg font-medium">{{ $jobCategy4->category }}</div>
                                            <div class="mt-1 text-slate-500">{{ $jobCategy4jobs }}</div>
                                        </div>
                                        <div class="relative ml-auto flex-none">
                                            <!-- <div class="w-[90px] h-[90px]">
                                                                            <canvas class="chart report-donut-chart-1 report-donut-chart-1" style="display: block; box-sizing: border-box; height: 90px; width: 90px;" width="135" height="135"></canvas>
                
                                                                        </div>
                
                                                                        <div class="absolute top-0 left-0 flex h-full w-full items-center justify-center font-medium">
                                                                        {{ $acservice }}%
                                                                        </div> -->
                                            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                                            <canvas id="myChart3"
                                                style="font-size:14px;vertical-align: top;margin: 0px !important;paddibng:0px !important; width:100px;"
                                                options={options}></canvas>
                                            <script>
                                                const originalDoughnutDraw3 = Chart.controllers.doughnut.prototype.draw;

                                                Chart.helpers.extend(Chart.controllers.doughnut.prototype, {
                                                    draw: function() {
                                                        const chart = this.chart;
                                                        const {
                                                            width,
                                                            height,
                                                            ctx,
                                                            config
                                                        } = chart.chart;

                                                        const {
                                                            datasets
                                                        } = config.data;

                                                        const dataset = datasets[0];
                                                        const datasetData = dataset.data;
                                                        const completed = datasetData[0];
                                                        const text = `${completed}%`;
                                                        let x, y, mid;

                                                        originalDoughnutDraw3.apply(this, arguments);

                                                        const fontSize = (height / 100).toFixed(2);
                                                        ctx.font = fontSize + "em Lato, sans-serif";
                                                        ctx.textBaseline = "top";

                                                        x = Math.round((width - ctx.measureText(text).width) / 2);
                                                        y = (height / 2.2) - fontSize;
                                                        ctx.fillStyle = "#000000"
                                                        ctx.fillText(text, x, y);
                                                        mid = x + ctx.measureText(text).width / 2;
                                                    }
                                                });


                                                var context = document.getElementById('myChart3').getContext('2d');
                                                var percent_value = {{ $acservicechart }};
                                                var chart = new Chart(context, {
                                                    type: 'doughnut',
                                                    data: {
                                                        labels: ['', ''],
                                                        datasets: [{
                                                            label: 'First dataset',
                                                            data: [percent_value, 100 - percent_value],
                                                            backgroundColor: ['#f59e0b', '#164e63'],
                                                            borderWidth: 2,
                                                            fontColor: 'rgb(255, 0, 0)',
                                                            fontSize: 25
                                                        }]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        title: {
                                                            display: false,
                                                            position: "top",
                                                            fontStyle: "bold",
                                                            fullWidth: false,
                                                            padding: 0
                                                        },
                                                        pieHole: 0.2,
                                                        aspectRatio: 1,
                                                        cutoutPercentage: 80,
                                                        legend: {
                                                            display: false,
                                                            position: "top",
                                                            fullWidth: false,
                                                            labels: {
                                                                display: false,
                                                                usePointStyle: true,
                                                                fontSize: 24,
                                                                fontStyle: "bold"
                                                            }

                                                        }
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>





                    <div
                        class="top-0 right-0 z-30 grid w-full h-full grid-cols-12 gap-6 pb-6 -mt-8 xl:absolute xl:z-auto xl:mt-0 xl:pb-0">
                        <div class="z-30 col-span-12 xl:col-span-3 xl:col-start-10 xl:pb-16">
                            <div class="flex flex-col h-full">
                                <div class="p-5 box intro-x bg-primary" style="background: (255 255 255);">
                                    <div class="flex flex-wrap gap-3">
                                        <div class="mr-auto">
                                            <div class="flex items-center leading-3 text-white text-opacity-70 dark:text-slate-300"
                                                style="font-size: 17px;   line-height: 26px; font-weight: 400; color: white;">
                                                <x-base.lucide class="h-10 w-10 text-warning fontsi" icon="ThumbsUp"
                                                    style="color: white; height: 67px; width: 55px;" />
                                                Complete Complain {{ $completejob }}
                                            </div>
                                            <!--<div class="relative mt-3.5 pl-4 text-2xl font-medium leading-5 text-white"-->
                                            <!--    style="padding-left: 0px; font-size: 34px;">-->

                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-x xl:min-h-0">
                                    <x-base.tab.group class="max-h-full mt-5 box xl:overflow-y-auto">
                                        <div class="w3-bar w3-black" style="padding: 10px; display: flex;">
                                            <button class="w3-bar-item w3-button" onclick="openCity('London')"
                                                style="text-align: center; color: white; margin: 5px; background: #164e63; padding: 10px; font-weight: 700; border-radius: 6px;">
                                                Today Complain
                                            </button>
                                            <button class="w3-bar-item w3-button" onclick="openCity('Paris')"
                                                style="text-align: center; color: white; margin: 5px; background: #164e63; padding: 10px; font-weight: 700; border-radius: 6px;">
                                                Total Complain
                                            </button>
                                        </div>

                                        <div id="London" class="w3-container city" style="padding: 0px 15px 20px;">
                                            <x-base.tab.panel class="grid grid-cols-12 gap-y-6" id="weekly-report"
                                                selected style="row-gap: 0.5rem;">

                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px;  background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.complaint') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Monitor" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.complaint') }}">
                                                            Today Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todayComplaints }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px; background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Assign') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileMinus" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Assign') }}">
                                                            Assign Complain</a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todayassignComplaintCount }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job.processing') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Monitor" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job.processing') }}">
                                                            Processing Complain</a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todayProcessCompl }}</div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                style="padding: 10px 6px 7px; background: #f59e0b;  border-radius: 6px;">
                                                <div class="text-slate-500"
                                                    style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                    <x-base.lucide class="h-10 w-10 text-warning fontsi" icon="FileMinus"
                                                        style="color:white; margin-right:10px;" />
                                                    <a href="{{ route('list.job','Open') }}">
                                                        Open Complain</a>
                                                </div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg" style="color: white;  font-weight: 700;">
                                                        {{ $todayopenComplaintCount }}</div>
                                                </div>
                                            </div> --}}
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Pending') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Pending') }}">
                                                            Pending Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todaypendingCompl }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Hold') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Pause" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Hold') }}">
                                                            Hold Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todayholdCompl }}</div>
                                                    </div>
                                                </div>


                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('upcuming-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('upcuming-amc') }}">
                                                            Up Coming AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todaytotalUpCommingAMC }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('panding-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Pause" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('panding-amc') }}">
                                                            Pending AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todaytotalpendingamc }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('expire-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('expire-amc') }}">
                                                            Expire AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $todaygetExpireDatacount }}</div>
                                                    </div>
                                                </div>
                                            </x-base.tab.panel>
                                        </div>

                                        <div id="Paris" class="w3-container city"
                                            style="display:none; padding:0px 15px 20px;">
                                            <x-base.tab.panel class="grid grid-cols-12 gap-y-6" id="weekly-report"
                                                selected style="row-gap: 0.5rem;">
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px;  background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.complaint') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Monitor" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.complaint') }}">
                                                            Total Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $totalComplaints }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px; background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Assign') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileMinus" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Assign') }}">
                                                            Assign Complain</a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $totalassignComplaintCount }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 6px 7px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job.processing') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Monitor" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job.processing') }}">
                                                            Processing Complain</a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $ProcessCompl }}</div>
                                                    </div>
                                                </div>

                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Pending') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Pending') }}">
                                                            Pending Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $pendingCompl }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('list.job', 'Hold') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Pause" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('list.job', 'Hold') }}">
                                                            Hold Complain </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $holdCompl }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('upcuming-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('upcuming-amc') }}">
                                                            Up Coming AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $totalUpCommingAMC }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px; background: #164e63;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('panding-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="Pause" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('panding-amc') }}">
                                                            Pending AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $totalpendingamc }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12"
                                                    style="padding: 10px 8px 9px;  background: #f59e0b;  border-radius: 6px;"
                                                    onclick="window.location.href = '{{ route('expire-amc') }}';">
                                                    <div class="text-slate-500"
                                                        style="font-weight: 600;    display: flex; color: white; font-size: 14px;">
                                                        <x-base.lucide class="h-10 w-10 text-warning fontsi"
                                                            icon="FileText" style="color:white; margin-right:10px;" />
                                                        <a href="{{ route('expire-amc') }}">
                                                            Expire AMC </a>
                                                    </div>
                                                    <div class="mt-1.5 flex items-center">
                                                        <div class="text-lg" style="color: white;  font-weight: 700;">
                                                            {{ $getExpireDatacount }}</div>
                                                    </div>
                                                </div>

                                            </x-base.tab.panel>
                                        </div>

                                        <script>
                                            function openCity(cityName) {
                                                var i;
                                                var x = document.getElementsByClassName("city");
                                                for (i = 0; i < x.length; i++) {
                                                    x[i].style.display = "none";
                                                }
                                                document.getElementById(cityName).style.display = "block";
                                            }
                                        </script>


                                    </x-base.tab.group>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-span-12 col-span-12" style="margin-top: 60px;">

                <div class="grid grid-cols-12 gap-6">


                    <!-- BEGIN: General Report -->

                    <div class="col-span-6">

                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium" style="color: #164e63; font-size: 23px;">
                                Complain
                            </h2>
                        </div>

                        <div class="mt-5 grid grid-cols-12 gap-6">

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('list.complaint') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="FileMinus" />

                                            </div>

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $totalComplaints }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Open Complains</div>

                                            </div>

                                        </div>
                                    </a>

                                </div>

                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('list.job', 'Hold') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="Pause" />

                                            </div>
                                            @php

                                                $complaintscount = DB::table('jobs')

                                                    ->where('status', 'Hold')

                                                    ->count();

                                            @endphp

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $complaintscount }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Hold Complains</div>

                                            </div>

                                        </div>
                                    </a>

                                </div>

                            </div>


                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('list.complaint') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="Monitor" />

                                            </div>

                                            @php

                                                $complaintscount = DB::table('jobs')

                                                    ->where('status', 'Pending')

                                                    ->count();

                                            @endphp

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $complaintscount }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Pending complaint
                                                </div>

                                            </div>

                                        </div>
                                    </a>

                                </div>

                            </div>


                            <!-- <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                                                            <div @class([
                                                                'relative zoom-in',
                                                            
                                                                'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                                            ])>

                                                                <a href={{ route('upcuming-amc') }}>

                                                                <div class="box p-5">

                                                                    <div class="flex">

                                                                        <x-base.lucide

                                                                            class="h-[28px] w-[28px] text-success"

                                                                            icon="aperture"

                                                                        />



                                                                    </div>

                                                                    <div class="mt-6 text-3xl font-medium leading-8">{{ $totalUpCommingAMC }}</div>

                                                                    <div class="mt-1 text-base text-slate-500">

                                                                     <div class="mt-1 text-base text-slate-500">Up-Comming AMC</div>



                                                                    </div>

                                                                </div>

                                                            </a>

                                                            </div>

                                                        </div> -->

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('complainreport') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="ThumbsUp" />

                                            </div>
                                            @php

                                                $complaintscount = DB::table('jobs')

                                                    ->where('status', 'Complete')

                                                    ->count();

                                            @endphp

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $complaintscount }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Complete Complains</div>



                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-span-6">

                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium" style="color: #164e63; font-size: 23px;">AMC
                            </h2>
                        </div>

                        <div class="mt-5 grid grid-cols-12 gap-6">

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('list.amc') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-success" icon="aperture" />

                                            </div>

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $totalAmc }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">AMC</div>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('upcuming-amc') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-success" icon="ArrowRight" />

                                            </div>

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $totalUpCommingAMC }}
                                            </div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Up-Comming AMC</div>



                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('panding-amc') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-success" icon="Clock" />

                                            </div>

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $totalpendingamc }}</div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Pending AMC</div>



                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                            <!-- Chang 2 -->

                            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                                <div @class([
                                    'relative zoom-in',
                                
                                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                                ])>

                                    <a href={{ route('expire-amc') }}>

                                        <div class="box p-5">

                                            <div class="flex">

                                                <x-base.lucide class="h-[28px] w-[28px] text-success" icon="RefreshCw" />

                                            </div>

                                            <div class="mt-6 text-3xl font-medium leading-8">{{ $getExpireDatacount }}
                                            </div>

                                            <div class="mt-1 text-base text-slate-500">

                                                <div class="mt-1 text-base text-slate-500">Expire-AMC</div>



                                            </div>

                                        </div>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- Table Css 1 -->

        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <x-base.dialog id="delete-confirmation-modal">
            <x-base.dialog.panel>
                <div class="p-5 text-center">
                    <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
                    <div class="mt-5 text-3xl">Are you sure?</div>
                    <div class="mt-2 text-slate-500">
                        Do you really want to delete these records? <br />
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                        Cancel
                    </x-base.button>
                    <x-base.button class="w-24" type="button" variant="danger">
                        Delete
                    </x-base.button>
                </div>
            </x-base.dialog.panel>
        </x-base.dialog>
        <!-- END: Delete Confirmation Modal -->


        <style>
            .before\:bg-slate-50:before {

                content: var(--tw-content);

                --tw-bg-opacity: 1;

                background-color: transparent;

            }
        </style>

        <div class="col-span-12 col-span-12">

            <div class="grid grid-cols-12 gap-6">

                <!-- BEGIN: General Report -->

                <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-10 xl:col-span-6">



                    <div
                        class="intro-y relative mt-12 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70 sm:mt-5">



                        <div class="intro-x flex h-10 items-center">

                            <h2 class="mr-5 truncate text-lg font-medium">

                                Open Complain

                            </h2>

                        </div>

                        <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table">

                            <x-base.table.thead class='text-center'>

                                <x-base.table.tr>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Complaint No

                                    </x-base.table.th>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Customer Name

                                    </x-base.table.th>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Created At

                                    </x-base.table.th>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Acction

                                    </x-base.table.th>

                                </x-base.table.tr>

                            </x-base.table.thead>

                            <x-base.table.tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($openComplaintList as $row)
                                    @php
                                        $i++;
                                        $getJobData = DB::table('jobs')
                                            ->where('complaint_id', $row->id)
                                            ->count();

                                        //$getJobData=0;

                                    @endphp
                                    @if ($getJobData == 0)
                                        <x-base.table.tr class="intro-x">

                                            <x-base.table.td
                                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                                {{ $row->ref_no }}

                                            </x-base.table.td>

                                            <x-base.table.td
                                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                                {{ $row->name ?? '' }}

                                            </x-base.table.td>



                                            <x-base.table.td
                                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                                {{ $row->created_at }}

                                            </x-base.table.td>

                                            <x-base.table.td
                                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                                <!-- @if ($getJobData == 0)
    <a class='btn btn-sm bg-warning text-white' href='{{ route('job.create.form', ['Id' => $row->id]) }}' >Create-Job</a>
@else
    <div class="flex items-center justify-center text-success">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                                                                Job-Created

                                                            </div>
    @endif -->





                                                <!-- <a

                                                                class="mr-3 flex items-center"

                                                                href="{{ route('edit.complaint', $row->id) }}"

                                                            >

                                                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]: disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning mb-2 mr-1 mb-2 mr-1"><i data-lucide="share" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                            </a>



                                                            <a

                                                                class="flex items-center text-danger"

                                                                href="{{ route('del.complaint', $row->id) }}"

                                                            >

                                                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger mb-2 mr-1 mb-2 mr-1"><i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                            </a> -->

                                                <!--<a-->

                                                <!--    class="mr-3 flex items-center"-->

                                                <!--    href="{{ route('edit.complaint', $row->id) }}"-->

                                                <!-->

                                                            <!--    <x-base.lucide-->

                                                <!--        class="mr-1 h-4 w-4"-->

                                                <!--        icon="CheckSquare"-->

                                                <!--    />-->

                                                <!--    Edit-->

                                                <!--</a>-->

                                                <a href="{{ route('edit.complaint', $row->id) }}">

                                                    <button data-tw-merge
                                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-dark border-dark text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i
                                                            data-lucide="edit" width="24" height="24"
                                                            class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                </a>

                                                <!-- <a class='btn bg-danger btn-sm text-white mt-2' href='{{ route('del.complaint', $row->id) }}'>Delete</a> -->


                                                <a data-tw-merge data-tw-toggle="modal"
                                                    data-tw-target="#delete-modal-preview{{ $i }}">
                                                    <button data-tw-merge
                                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1">
                                                        <i data-lucide="trash" width="24" height="24"
                                                            class="stroke-1.5 h-5 w-5 h-5 w-5"></i>
                                                    </button>
                                                </a>

                                                <!-- <a href="{{ route('del.complaint', $row->id) }}">
                                                                <button data-tw-merge type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>
                                                                </a> -->


                                                <!-- BEGIN: Modal Content -->
                                                <div data-tw-backdrop="" aria-hidden="true" tabindex="-1"
                                                    id="delete-modal-preview{{ $i }}"
                                                    class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
                                                    <div
                                                        class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
                                                        <div class="p-5 text-center">
                                                            <i data-lucide="x-circle" width="24" height="24"
                                                                class="stroke-1.5 w-16 h-16 mx-auto mt-3 text-danger w-16 h-16 mx-auto mt-3 text-danger"></i>


                                                            <div class="mt-5 text-3xl">Are you sure?</div>
                                                            <div class="mt-2 text-slate-500">
                                                                Do you really want to delete these records? <br />
                                                                This process cannot be undone.
                                                            </div>
                                                        </div>
                                                        <div class="px-5 pb-8 text-center">
                                                            <button data-tw-merge data-tw-dismiss="modal" type="button"
                                                                class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&amp;:hover:not(:disabled)]:bg-secondary/20 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-100/10 w-24 mr-1 w-24 mr-1">Cancel</button>

                                                            <a href="{{ route('del.complaint', $row->id) }}">
                                                                <button data-tw-merge type="button"
                                                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger w-24 w-24">Delete</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END: Modal Content -->


                                                <!--@if ($getJobData == 0)
    -->
                                                <!--   <a href="{{ route('job.create.form', ['Id' => $row->id]) }}">-->
                                                <!--       <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">-->
                                                <!--       <i data-lucide="file" width="15" height="15" class="stroke-1.5 h-5 w-8"></i>Create-Job</button>-->
                                                <!--   </a>-->

                                                <!--
    @endif-->


                                            </x-base.table.td>

                                        </x-base.table.tr>
                                    @endif
                                @endforeach

                            </x-base.table.tbody>

                        </x-base.table>

                        <!--<div class="mt-2 text-right">-->

                        <!--    {{ $openComplaintList->links('pagination.custom') }}-->

                        <!--</div>-->







                    </div>

                </div>



                <!-- END: General Report -->

                <!-- BEGIN: General Report -->

                <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-10 xl:col-span-6">



                    <div
                        class="intro-y relative mt-12 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70 sm:mt-5">





                        <div class="intro-x flex h-10 items-center background-box text-center">

                            <h2 class="mr-5 truncate text-lg font-medium">Pending Complain</h2>

                        </div>

                        <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table">

                            <x-base.table.thead class='text-center'>

                                <x-base.table.tr>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Complaint No

                                    </x-base.table.th>

                                    <x-base.table.th class="border-b-0 whitespace-nowrap">

                                        Customer Name

                                    </x-base.table.th>

                                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                                        Created At

                                    </x-base.table.th>

                                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                                        Acction

                                    </x-base.table.th>

                                </x-base.table.tr>

                            </x-base.table.thead>

                            <x-base.table.tbody>

                                @foreach ($pendingComplaintList as $row)
                                    <!-- @php

                                        $getJobData = DB::table('jobs')
                                            ->where('complaint_id', $row->id)
                                            ->count();

                                        $getJobData = 0;

                                    @endphp -->

                                    <x-base.table.tr class="intro-x">

                                        <x-base.table.td
                                            class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                            {{ $row->name }}

                                        </x-base.table.td>

                                        <x-base.table.td
                                            class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                            <!-- {{ $row->customer->name ?? 'N/A' }} -->
                                            <a href='{{ route('job.invoice', $row->id) }}'
                                                target='_BLANK'>{{ $row->job_ref_no }}</a>

                                        </x-base.table.td>



                                        <x-base.table.td
                                            class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                            {{ $row->created_at }}

                                        </x-base.table.td>

                                        <x-base.table.td
                                            class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">



                                            <!--<a-->

                                            <!--    class="mr-3 flex items-center"-->

                                            <!--    href="{{ route('edit.complaint', $row->id) }}"-->

                                            <!-->

                                                                                <!--    <x-base.lucide-->

                                            <!--        class="mr-1 h-4 w-4"-->

                                            <!--        icon="CheckSquare"-->

                                            <!--    />-->

                                            <!--    Edit-->

                                            <!--</a>-->

                                            <!-- <a href="{{ route('edit.complaint', $row->id) }}">

                                                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-dark border-dark text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="edit" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                                                </a>

                                                                                

                                                                                <a href="{{ route('del.complaint', $row->id) }}">

                                                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-denger text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                                                </a> -->


                                            <a class="flex items-center text-success"
                                                href="{{ route('job.assign_technician', ['id' => $row->id]) }}">

                                                <x-base.lucide class="mr-1 h-4 w-4" icon="CheckSquare" />

                                                Assign

                                            </a>

                                        </x-base.table.td>

                                    </x-base.table.tr>
                                @endforeach

                            </x-base.table.tbody>

                        </x-base.table>

                        <div class="mt-2 text-right">

                            {{ $pendingComplaintList->links('pagination.custom') }}

                        </div>

                    </div>







                </div>

            </div>



            <style>
                .content-table {

                    border-collapse: collapse;

                    margin: 25px 0;

                    font-size: 0.9em;

                    min-width: 400px;

                    border-radius: 5px 5px 0 0;

                    overflow: hidden;

                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

                }



                .content-table thead tr {

                    background-color: #164E63;
                    /* Updated color */

                    color: #ffffff;

                    text-align: left;

                    font-weight: bold;

                }



                .content-table th,

                .content-table td {

                    padding: 12px 15px;

                }



                .content-table tbody tr {

                    border-bottom: 1px solid #dddddd;

                }



                .content-table tbody tr:nth-of-type(even) {

                    background-color: #f3f3f3;

                }



                .content-table tbody tr:last-of-type {

                    border-bottom: 2px solid #164E63;
                    /* Updated color */

                }



                .content-table tbody tr.active-row {

                    font-weight: bold;

                    color: #164E63;
                    /* Updated color */

                }
            </style>

            <!-- END: Weekly Top Products -->

            <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2">

                <div class="intro-x flex h-10 items-center">

                    <h2 class="mr-5 truncate text-lg font-medium">

                        Inprocess Complain

                    </h2>

                </div>

                <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table">

                    <x-base.table.thead>

                        <x-base.table.tr>

                            <x-base.table.th class="border-b-0 whitespace-nowrap">

                                Customer Name

                            </x-base.table.th>

                            <x-base.table.th class=" border-b-0 whitespace-nowrap">

                                Complaint No

                            </x-base.table.th>

                            <!--<x-base.table.th class="border-b-0 whitespace-nowrap">-->

                            <!--    Product-->

                            <!--</x-base.table.th>-->

                            <x-base.table.th class=" border-b-0 whitespace-nowrap">

                                job_category

                            </x-base.table.th>

                            <x-base.table.th class=" border-b-0 whitespace-nowrap">

                                Customer Address

                            </x-base.table.th>

                            <x-base.table.th class="border-b-0 whitespace-nowrap">

                                Supervisor Name

                            </x-base.table.th>

                            <x-base.table.th class="border-b-0 whitespace-nowrap">

                                Assign To

                            </x-base.table.th>

                            <x-base.table.th class="border-b-0 whitespace-nowrap">

                                Helper

                            </x-base.table.th>

                            <x-base.table.th class="border-b-0 whitespace-nowrap">

                                Action

                            </x-base.table.th>



                        </x-base.table.tr>

                    </x-base.table.thead>

                    <x-base.table.tbody>

                        @foreach ($jobs as $row)
                            @php

                                $customercount = DB::table('customer_details')

                                    ->where('id', $row->address)

                                    ->count();

                                // print_r($jobs);

                                // exit;

                            @endphp



                            <x-base.table.tr class="intro-x">

                                <!-- <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                                                           {{ $row->id }}

                                                                        </x-base.table.td> -->

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    {{ $row->name }}

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    <a href='{{ route('job.invoice', $row->id) }}'
                                        target='_BLANK'>{{ $row->job_ref_no }}</a>

                                </x-base.table.td>

                                <!--<x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >-->

                                <!--   {{ $row->product }}-->

                                <!--</x-base.table.td>-->

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    {{ $row->job_category }}

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    <!--{{ $row->address }} {{ $row->city }} {{ $row->postal_code }}-->

                                    @if ($customercount > 0)
                                        @php

                                            $customerlocation = DB::table('customer_details')

                                                ->where('id', $row->address)

                                                ->first();

                                            $locatyion = $customerlocation->location_type;

                                        @endphp
                                    @else
                                        @php $locatyion =''; @endphp
                                    @endif

                                    {{ $locatyion }}

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    {{ $row->supervisor_name }}

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">



                                    <div class="flex items-center text-danger">

                                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>-->

                                        <!--{{ $row->status }}-->



                                    </div>



                                    @if ($row->technician_id != '0')
                                        @php

                                            $technicians = DB::table('technicians')
                                                ->where('id', $row->technician_id)
                                                ->first();

                                            if (empty($getIn)) {
                                                echo '' . $technicians->name . '';
                                            }

                                        @endphp
                                    @endif

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">


                                    @php

                                        $helper = DB::table('helper')
                                            ->where('id', $row->id)
                                            ->first();

                                        if ($helper !== null) {
                                            echo "$helper->name";
                                        }
                                    @endphp


                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    <!-- <a class='btn btn-success btn-sm' href="{{ route('job.assign_technician', ['id' => $row->id]) }}"> Assign / Change Job</a> -->
                                    <a class="flex items-center text-success"
                                        href="{{ route('job.assign_technician', ['id' => $row->id]) }}">
                                        <x-base.lucide class="mr-1 h-4 w-4" icon="CheckSquare" />
                                        Assign
                                    </a>



                                </x-base.table.td>



                            </x-base.table.tr>
                        @endforeach

                    </x-base.table.tbody>

                </x-base.table>

                <!--<div class="mt-2 text-right">-->

                <!--    {{ $jobs->links('pagination.custom') }}-->

                <!--</div>-->

            </div>

        </div>


        <!--Official Store -->





    </div>
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-12 mt-6 xl:col-span-8">

            <div class="intro-y block h-10 items-center sm:flex">

                <h2 class="mr-5 truncate text-lg font-medium">Technician Location</h2>

            </div>

            @php

                $loctechnicount = DB::table('attendances')
                    ->where('check_status', 'In')
                    ->select('technician_id')
                    ->groupby('technician_id')
                    ->count();

                $loctechnician = DB::table('attendances')
                    ->where('check_status', 'In')
                    ->select('technician_id')
                    ->groupby('technician_id')
                    ->get();
                $loc = '';
            @endphp

            @foreach ($loctechnician as $row4777)
                @php
                    $techid = $row4777->technician_id;

                    $technician = DB::table('attendances')
                        ->where('technician_id', $techid)
                        ->where('check_status', 'In')
                        ->orderby('id', 'DESC')
                        ->first();

                    $techniciancount = DB::table('technicians')->where('id', $techid)->count();

                    if ($techniciancount > 0) {
                        $technicianname = DB::table('technicians')->where('id', $techid)->first();
                        $tname = '<b>' . $technicianname->name . '</b><br>' . $technician->address;
                    } else {
                        $tname = '<b>SK Enterprise' . '</b><br>' . $technician->address;
                    }

                    $address = str_replace("'", '', $technician->address);
                    $name = str_replace("'", '', $tname);

                    $loc .=
                        '{"DisplayText": "' .
                        $name .
                        '", "ADDRESS": "' .
                        $address .
                        '" , "LatitudeLongitude": "' .
                        $technician->latitude .
                        ',' .
                        $technician->longitude .
                        '", "MarkerId": "Customer"},';

                @endphp
            @endforeach

            @php $location = substr_replace($loc, "", -1); @endphp

            <div class="intro-y box mt-12 p-5 sm:mt-5">

                <!-- <div>

                                            {{ $loctechnicount }} Official stores in 21 countries, click the marker to see

                                            location details.

                                        </div> -->

                <div id="map-canvas" style="width: 100%; display: inline-block; height: 400px; border-radius: 6px;">
                </div>


                </body>

                </html>
                <!-- <x-leaflet-map class="mt-5 h-[310px] rounded-md bg-slate-200" /> -->

            </div>

        </div>

        <!--END: Official Store -->



        <!-- Weekly Best Sellers -->

        <div class="col-span-12 mt-6 xl:col-span-4">

            <div class="intro-y flex h-10 items-center">

                <h2 class="mr-5 truncate text-lg font-medium">

                    Our Best Technicians

                </h2>

            </div>

            @php

                $tech_new = DB::table('technicians')
                    ->select(['technicians.id', DB::raw('COUNT(jobs.id) as count')])
                    ->where('technicians.id', '!=', 0)
                    ->join('jobs', 'jobs.technician_id', '=', 'technicians.id')
                    ->where('jobs.status', 'Complete')
                    ->groupby('technicians.id')
                    ->orderby('count', 'desc')
                    ->limit(5)
                    ->get();

                $i = 0;
            @endphp

            <div class="mt-5">
                @foreach ($tech_new as $row44)
                    @php
                        $i++;
                        $technicianscount = DB::table('technicians')
                            ->where('id', $row44->id)
                            ->count();
                    @endphp
                    @if ($technicianscount > 0)
                        @php
                            $technicians = DB::table('technicians')
                                ->where('id', $row44->id)
                                ->first();
                        @endphp
                        <div class="intro-y">
                            <div class="box zoom-in mb-3 flex items-center px-4 py-4">
                                <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-md">
                                    <img class="rounded-full"
                                        src="{{ asset('technician_images/' . $technicians->profile_image) }}"
                                        alt="{{ $technicians->name }}" />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $technicians->name }}</div>
                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $technicians->user_name }}
                                    </div>
                                </div>
                                <div
                                    class="cursor-pointer rounded-full bg-success px-2 py-1 text-xs font-medium text-white">
                                    {{ $row44->count }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <a class="intro-y block w-full rounded-md border border-dotted border-slate-400 py-4 text-center text-slate-500 dark:border-darkmode-300"
                    href="{{ route('technicianreport') }}">
                    View More
                </a>
            </div>

        </div>


    </div>
    </div>

    </div>
@endsection

@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&sensor=true"
        type="text/javascript"></script>

    <script type="text/javascript">
        var map;
        var geocoder;
        var marker;
        var people = new Array();
        var latlng;
        var infowindow;

        $(document).ready(function() {
            ViewCustInGoogleMap();
        });

        function ViewCustInGoogleMap() {

            var mapOptions = {
                center: new google.maps.LatLng(21.1594406, 72.65748),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // Get data from database. It should be like below format or you can alter it.


            var data = '[@php echo $location; @endphp]';
            people = JSON.parse(data);

            for (var i = 0; i < people.length; i++) {
                setMarker(people[i]);
            }

        }

        function setMarker(people) {
            geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people[
                    "LatitudeLongitude"] == '')) {
                geocoder.geocode({
                    'address': people["Address"]
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry
                            .location.lng());
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: false,
                            html: people["DisplayText"],
                            icon: "images/marker/" + people["MarkerId"] + ".png"
                        });
                        //marker.setPosition(latlng);
                        //map.setCenter(latlng);
                        google.maps.event.addListener(marker, 'click', function(event) {
                            infowindow.setContent(this.html);
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map, this);
                        });
                    } else {
                        alert(people["DisplayText"] + " -- " + people["Address"] +
                            ". This address couldn't be found");
                    }
                });
            } else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false, // cant drag it
                    html: people["DisplayText"] // Content display on marker click
                    //icon: "images/marker.png"       // Give ur own image
                });
                //marker.setPosition(latlng);
                //map.setCenter(latlng);
                google.maps.event.addListener(marker, 'click', function(event) {
                    infowindow.setContent(this.html);
                    infowindow.setPosition(event.latLng);
                    infowindow.open(map, this);
                });
            }
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>

    <script>
        $('body').on('change', '#slected_date', function() {

            // alert();

            var slected_date = $(this).val();

            jQuery.ajax({

                url: '{{ route('change-checkin-count') }}',

                type: "POST",

                data: {

                    _token: "{{ csrf_token() }}",

                    date: slected_date

                },

                success: function(data) {

                    console.log(data.totalAbsent);

                    $('#totalAbsent').text(data.totalAbsent)

                    $('#totalchheckin').text(data.checkinCounts)



                }

            });

        });

        var totalTechnician = {{ $totalTechnician }};

        var chartData = {

            labels: ["Active Users", "Inactive Users"],

            datasets: [{

                data: [totalTechnician, 100 - totalTechnician], // Assuming a 100% scale

                backgroundColor: ["#2d9cdb", "#e2e8f0"], // Customize colors as needed

                borderWidth: 0,

            }],

        };



        var options = {

            responsive: true,

            cutout: "80%", // Adjust the cutout percentage as desired

        };



        var ctx = document.getElementById("dynamicDonutChart").getContext("2d");

        new Chart(ctx, {

            type: "doughnut",

            data: chartData,

            options: options,

        });

        <
        script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js" >
    </script>

    <script>
        var totalTechnician = {{ $totalTechnician }};

        var chartData = {

            labels: ["Active Users", "Inactive Users"],

            datasets: [{

                data: [totalTechnician, 100 - totalTechnician], // Assuming a 100% scale

                backgroundColor: ["#2d9cdb", "#e2e8f0"], // Customize colors as needed

                borderWidth: 0,

            }],

        };



        var options = {

            responsive: true,

            cutout: "80%", // Adjust the cutout percentage as desired

        };



        var ctx = document.getElementById("dynamicDonutChart").getContext("2d");

        new Chart(ctx, {

            type: "doughnut",

            data: chartData,

            options: options,

        });
    </script>



    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var totalTechnician = {{ $totalTechnician }};
        var checkinCounts = {{ $checkinCounts }};
        var totalAbsent = {{ $totalAbsent }};
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Total Technician', totalTechnician],
                ['Total Check-In', checkinCounts],
                ['Total Check-Out', totalAbsent]
            ]);

            var options = {
                title: '',
                pieHole: 0.5,
                legend: 'none',
                width: '90%',
                height: '90%',
                colors: ['#164e63', '#d97706', '#f59e0b'],
                chartArea: {
                    height: "90%",
                    width: "90%"
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
@endpush
