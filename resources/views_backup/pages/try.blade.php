@extends('../layouts/side-menu')



@section('subhead')

    <title>Dashboard - Sk Backend</title>

@endsection



@section('subcontent')

<style>

.w-full

{

    font-size:12px !important;

}

.fontsi

{

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



</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&sensor=true" type="text/javascript"></script>

<style type="text/css">
    	#mymap {
      		border:1px solid red;
      		width: 800px;
      		height: 500px;
    	}
  	</style>



    <div class="grid grid-cols-15 gap-6">
        <div class="col-span-12 mt-2 sm:col-span-12 lg:col-span-12 xl:col-span-12">

            <div class="col-span-12 mt-2 sm:col-span-12 lg:col-span-12 xl:col-span-12">

            <h2 class="mr-5 truncate text-lg font-medium">Dashboard</h2>


            </div>
            <div class="relative">
                <div class="grid grid-cols-12 gap-6">
                    <div class="z-20 col-span-12 xl:col-span-9 2xl:col-span-9" style="background: white;">
                    
                        <div class="grid grid-cols-12 mb-3 intro-y mt-14 sm:gap-10">
                            <div
                                class="relative col-span-12 py-6 text-center sm:col-span-6 sm:pl-5 sm:text-left md:col-span-4 md:pl-0 lg:pl-5">
                                <div
                                    class="flex items-center justify-center text-base leading-3 mt-14 text-slate-600 dark:text-slate-300 sm:justify-start 2xl:mt-24 2xl:text-lg" style="display: contents;">
                                    Total Complaints
                                    <x-base.tippy
                                        as="div"
                                        content="Total value of your sales: $158.409.416"
                                    >
                                        <x-base.lucide
                                            class="ml-1.5 mt-0.5 h-5 w-5"
                                            icon="AlertCircle"
                                        />
                                    </x-base.tippy>
                                </div>
                                <div class="mt-5 mb-3 2xl:flex">
                                    <div class="flex items-center justify-center sm:justify-start">
                                        <div class="relative pl-3 text-2xl font-medium leading-6 2xl:pl-4 2xl:text-3xl">
                                            <!-- <span class="absolute top-0 left-0 -mt-1 text-xl 2xl:mt-0 2xl:text-2xl">
                                                $
                                            </span> -->
                                            {{ $totalComplaints }}
                                        </div>
                                        <a
                                            class="ml-4 text-slate-500 2xl:ml-16"
                                            href=""
                                        >
                                            <x-base.lucide
                                                class="w-4 h-4"
                                                icon="RefreshCcw"
                                            />
                                        </a>
                                    </div>
                                </div>
                                <x-base.menu
                                    class="mt-14 w-44 2xl:mt-24 2xl:w-52"
                                    placement="bottom-start"
                                >
                                <a  href="{{ route('create.complaint') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Complaint</a>
                    
                                <a  href="{{ route('create.customer.form') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Customer</a> 

                                    
                                    <a  href="{{ route('complainreport') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style=" width: 100%;">Complaints Reports</a>

                                    <!-- <x-base.menu.items class="w-44 2xl:w-52">
                                        <x-base.menu.item>
                                            <x-base.lucide
                                                class="w-4 h-4 mr-2"
                                                icon="FileText"
                                            />
                                            Monthly Report
                                        </x-base.menu.item>
                                        <x-base.menu.item>
                                            <x-base.lucide
                                                class="w-4 h-4 mr-2"
                                                icon="FileText"
                                            />
                                            Annual Report
                                        </x-base.menu.item>
                                    </x-base.menu.items> -->
                                </x-base.menu>
                            </div>
                            <div
                                class="col-span-12 row-start-2 px-10 py-6 -mx-5 border-t border-black border-dashed border-opacity-10 sm:px-28 md:col-span-4 md:row-start-auto md:border-t-0 md:border-l md:border-r md:px-5">
                                <div
                                    class="flex items-center justify-center text-base leading-3 mt-14 text-slate-600 dark:text-slate-300 sm:justify-start 2xl:mt-24 2xl:text-lg">
                                    Total AMC
                                    <x-base.tippy
                                        as="div"
                                        content="Total value of your sales: $158.409.416"
                                    >
                                        <x-base.lucide
                                            class="ml-1.5 mt-0.5 h-5 w-5"
                                            icon="AlertCircle"
                                        />
                                    </x-base.tippy>
                                </div>
                                <div class="mt-5 mb-3 2xl:flex">
                                    <div class="flex items-center justify-center sm:justify-start">
                                        <div class="relative pl-3 text-2xl font-medium leading-6 2xl:pl-4 2xl:text-3xl">
                                            <!-- <span class="absolute top-0 left-0 -mt-1 text-xl 2xl:mt-0 2xl:text-2xl">
                                                $
                                            </span> -->
                                            {{ $totalAmc }}
                                        </div>
                                        <a
                                            class="ml-4 text-slate-500 2xl:ml-16"
                                            href=""
                                        >
                                            <x-base.lucide
                                                class="w-4 h-4"
                                                icon="RefreshCcw"
                                            />
                                        </a>
                                    </div>
                                </div>
                               
                                <div class="mt-4 mb-2 flex border-b border-slate-200 pb-2 text-xs text-slate-500">

                                    <div>AMC Page</div>

                                    <div class="ml-auto">Active Users</div>

                                </div>

                                

                                <div class="mt-1.5 flex">

                                    <div>Up Coming AMC</div>

                                    <div class="ml-auto">{{ $totalUpCommingAMC }}</div>

                                </div>

                                <div class="mt-1.5 flex">

                                    <div>Pending AMC</div>

                                    <div class="ml-auto">{{ $totalUpCommingAMC }}</div>

                                </div>

                                @php 

                                        $getExpireDatacount = DB::table('amcs')

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

                                        ->count();

                                        @endphp

                                <div class="mt-1.5 flex">

                                    <div>Expire AMC</div>

                                    <div class="ml-auto">{{$getExpireDatacount}}</div>

                                </div>

                                <x-base.button

                                    class="mt-4 w-full border-dashed px-2 py-1"

                                    variant="outline-secondary"

                                >

                                    <a href="/amc">Real Time Report</a>

                                </x-base.button>

                                <a  href="{{ route('amcreport') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style=" width: 100%;">AMC Reports</a>
                            </div>
                            <x-base.tab.group
                                class="col-span-12 py-6 pl-4 -ml-4 border-t border-l border-black border-dashed border-opacity-10 sm:col-span-6 sm:border-t-0 md:col-span-4 md:ml-0 md:border-l-0 md:pl-0"
                            >
                            <x-base.tab.list

                                class="mx-auto w-4/5 rounded-md bg-slate-100 dark:bg-black/20"

                                variant="pills"

                            >

                                <x-base.tab

                                    id="active-users-tab"

                                    selected

                                >

                                    <x-base.tab.button

                                        class="w-full py-1.5 px-2"

                                        as="button"

                                    >

                                    Attendance

                                    </x-base.tab.button>

                                </x-base.tab>

                            </x-base.tab.list>

                            <x-base.tab.panels class="mt-6" style="margin-top: 5px;">

                                <x-base.tab.panel

                                    id="active-users"

                                    selected

                                >

                                    <div class="relative">
                                        <div id="donutchart" style="width: 100%; text-align: center;"></div>
                                        <!-- <x-report-donut-chart

                                            class="mt-3"

                                            height="h-[208px]"

                                        />

                                        <div

                                            class="absolute top-0 left-0 flex h-full w-full flex-col items-center justify-center">

                                            <div class="text-2xl font-medium">{{ $totalTechnician}}</div>

                                            <div class="mt-0.5 text-slate-500">Active Users</div>

                                        </div> -->

                                    </div>

                                    <div class="mx-auto mt-5 w-52 sm:w-auto">

                                        <div class="flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>

                                            <span class="truncate">Total Technicians</span>

                                            <span class="ml-auto font-medium">{{ $totalTechnician}}</span>

                                        </div>

                                        <div class="mt-4 flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>

                                            <span class="truncate">Total Check-In</span>

                                            <span class="ml-auto font-medium"><span id="totalchheckin">{{ $checkinCounts}}</span></span>

                                        </div>

                                        <div class="mt-4 flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-warning"></div>

                                            <span class="truncate">Total Check-Out</span>

                                            <span class="ml-auto font-medium"><span id="totalAbsent"> {{ $totalAbsent}}</span></span>

                                        </div>

                                    </div>

                                </x-base.tab.panel>

                            </x-base.tab.panels>
                               
                            <a  href="{{ route('technicianreport') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style=" width: 100%;">Technician Reports</a>
                            </x-base.tab.group>
                        </div>
                    </div>
                    <div @class([
                        'z-10 col-span-12 px-5 pt-8 -mx-[16px] md:-mx-[22px] relative pb-14',
                        'before:content-[\'\'] before:rounded-[30px_30px_0px_0px] before:w-full before:h-full before:bg-slate-200/70 before:dark:bg-opacity-50 before:absolute before:top-0 before:left-0 before:right-0 before:dark:bg-darkmode-500',
                    ])>
                        <div class="relative grid grid-cols-12 gap-6 intro-y">
                            <div class="col-span-12 px-0 sm:col-span-4 lg:px-6 xl:col-span-3 xl:px-0 2xl:px-6">
                                <div class="flex flex-wrap items-center gap-3 lg:flex-nowrap">
                                    <div class="mr-auto text-lg font-medium truncate sm:w-full lg:w-auto">
                                        Summary Report
                                    </div>
                                    <div
                                        class="cursor-pointer truncate rounded-full bg-slate-300/50 py-1 px-2.5 text-xs text-slate-600 dark:bg-darkmode-400 dark:text-slate-300">
                                        180 Campaign
                                    </div>
                                </div>
                                <div class="px-10 sm:px-0">
                                    <x-simple-line-chart-3
                                        class="mt-8 -ml-1 -mb-7"
                                        height="h-[110px]"
                                    />
                                </div>
                            </div>
                            <div class="col-span-12 px-0 sm:col-span-4 lg:px-6 xl:col-span-3 xl:px-0 2xl:px-6">
                                <div class="flex flex-wrap items-center gap-3 lg:flex-nowrap">
                                    <div class="mr-auto text-lg font-medium truncate sm:w-full lg:w-auto">
                                        Social Media
                                    </div>
                                    <a
                                        class="flex items-center text-primary"
                                        href=""
                                    >
                                        <div class="truncate 2xl:mr-auto">View Details</div>
                                        <x-base.lucide
                                            class="w-4 h-4 ml-3"
                                            icon="ArrowRight"
                                        />
                                    </a>
                                </div>
                                <div class="flex items-center justify-center mt-10">
                                    <div class="text-right">
                                        <div class="text-3xl font-medium">{{$totalamc11}}</div>
                                        <div class="mt-1 truncate text-slate-500">Total MC</div>
                                    </div>
                                    <div
                                        class="w-px h-16 mx-4 border border-r border-dashed border-slate-300 dark:border-darkmode-400 xl:mx-6">
                                    </div>
                                    <div>
                                        <div class="text-3xl font-medium">{{$totaljobs11}}</div>
                                        <div class="mt-1 truncate text-slate-500">Total Complaint</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 px-0 sm:col-span-4 lg:px-6 xl:col-span-3 xl:px-0 2xl:px-6">
                                <div class="flex flex-wrap items-center gap-3 lg:flex-nowrap">
                                    <div class="mr-auto text-lg font-medium truncate sm:w-full lg:w-auto">
                                        Posted Ads
                                    </div>
                                    <div
                                        class="cursor-pointer truncate rounded-full bg-slate-300/50 py-1 px-2.5 text-xs text-slate-600 dark:bg-darkmode-400 dark:text-slate-300">
                                        320 Followers
                                    </div>
                                </div>
                                <div class="px-10 sm:px-0">
                                    <x-simple-line-chart-4
                                        class="mt-8 -ml-1 -mb-7"
                                        height="h-[110px]"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="top-0 right-0 z-30 grid w-full h-full grid-cols-12 gap-6 pb-6 -mt-8 xl:absolute xl:z-auto xl:mt-0 xl:pb-0">
                    <div class="z-30 col-span-12 xl:col-span-3 xl:col-start-10 xl:pb-16">
                        <div class="flex flex-col h-full">
                            <div class="p-5 mt-6 box intro-x bg-primary">
                                <div class="flex flex-wrap gap-3">
                                    <div class="mr-auto">
                                        <div class="flex items-center leading-3 text-white text-opacity-70 dark:text-slate-300">
                                            Complete Complaints
                                            <x-base.tippy
                                                as="div"
                                                content="Total value of your sales: $158.409.416"
                                            >
                                                <x-base.lucide
                                                    class="ml-1.5 h-4 w-4"
                                                    icon="AlertCircle"
                                                />
                                            </x-base.tippy>
                                        </div>
                                        <div class="relative mt-3.5 pl-4 text-2xl font-medium leading-5 text-white">
                                            <!-- <span class="absolute top-0 left-0 -mt-1.5 text-xl"> $ </span> -->
                                            {{$completejob}}
                                        </div>
                                    </div>
                                    <!-- <a
                                        class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-full bg-opacity-20 hover:bg-opacity-30 dark:bg-darkmode-300"
                                        href=""
                                    >
                                        <x-base.lucide
                                            class="w-6 h-6"
                                            icon="Plus"
                                        />
                                    </a> -->
                                </div>
                            </div>
                            <div class="intro-x xl:min-h-0">
                                <x-base.tab.group class="max-h-full mt-5 box xl:overflow-y-auto">
                                    <div class="top-0 px-5 pt-5 pb-6 xl:sticky">
                                        <x-base.tab.list
                                            class="p-1 mx-auto mt-5 border border-dashed rounded-md border-slate-300 dark:border-darkmode-300"
                                            variant="pills"
                                        >
                                            <x-base.tab
                                                id="weekly-report-tab"
                                                selected
                                            >
                                            <a  href="{{ route('complaint') }}"  class="w-full py-1.5 px-2">
                                                    Today Complaint
                                            </a>
                                            </x-base.tab>
                                            <x-base.tab id="monthly-report-tab">
                                                <a  href="{{ route('complaint') }}"  class="w-full py-1.5 px-2">
                                                Total Complaint
                                                </a>
                                            </x-base.tab>
                                            </x-base.tab>
                                        </x-base.tab.list>
                                    </div>
                                    <x-base.tab.panels class="px-5 pb-5">
                                        <x-base.tab.panel
                                            class="grid grid-cols-12 gap-y-6"
                                            id="weekly-report"
                                            selected
                                        >
                                            <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12">
                                                <div class="text-slate-500">Total Complain</div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg">{{$totalComplaints}}</div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12">
                                                <div class="text-slate-500">Processing Complain</div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg">{{$ProcessCompl}}</div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12">
                                                <div class="text-slate-500">Open Complain</div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg">{{$openComplaintCount}}</div>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12">
                                                <div class="text-slate-500">Pending Complain</div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg">{{$pendingCompl}}</div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-12">
                                                <div class="text-slate-500">Hold Complain</div>
                                                <div class="mt-1.5 flex items-center">
                                                    <div class="text-lg">{{$holdCompl}}</div>
                                                </div>
                                            </div>
                                        </x-base.tab.panel>
                                    </x-base.tab.panels>
                                </x-base.tab.group>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        



        <div class="col-span-12 col-span-12">

            <div class="grid grid-cols-12 gap-6">

                <!-- BEGIN: General Report -->

                <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-10 xl:col-span-6">

                    <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-10 xl:col-span-6">

                    <h2 class="mr-5 truncate text-lg font-medium">Dashboard</h2>
                    

                    </div>
                    
                    

                    <div

                        class="intro-y relative mt-12 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70 sm:mt-5">

                        <div class="box sm:flex h-[400px]">

                            <div class="flex flex-1 flex-col justify-top px-8 py-12">

                                <div style="display:flex;">

                                <div><x-base.lucide

                                    class="h-10 w-10 text-warning fouzal"

                                    icon="ShoppingBag"

                                />
                                
                                
                                </div>

                                <div style="font-size:25px; padding-top:10px; padding-left:10px;">Total Complaints</div>

                                 

                                </div>

                                <div class="relative mt-8 pl-4 text-3xl font-large">

                                {{ $totalComplaints }}

                                </div>

                                <div class="mt-4 text-slate-500">

                                    <!--Sales earnings this month after associated author fees, &-->

                                    <!--before taxes.-->

                                    ---------------------------------------

                                </div>

                                <div style="display:flex;" class="mt-8">

                                <div><x-base.lucide

                                    class="h-10 w-10 text-warning fouzal"

                                    icon="ThumbsUp"

                                /></div>

                                @php 

                                    $complaintscount = DB::table('jobs')

                                        ->where('status', 'Complete')

                                        ->count();

                                    @endphp

                                <div style="font-size:25px; padding-top:10px; padding-left:10px;">Complete Complain</div>

                                 

                                </div>

                                <div class="relative mt-8 pl-4 text-3xl font-large">

                                {{$complaintscount}}

                                </div>

                            </div>

                            <div

                                class="flex flex-1 flex-col justify-center border-t border-dashed border-slate-200 px-8 py-12 dark:border-darkmode-300 sm:border-t-0 sm:border-l">

                                <div class="text-xs text-slate-500" style="display:flex;"> 

                                <x-base.lucide

                                    class="h-10 w-10 text-warning fontsi"

                                    icon="Monitor"

                                />

                                Total Complain</div>

                                <div class="mt-1.5 flex items-center">

                                    <div class="text-base">{{ $totalComplaints }}</div>

                                </div>

                                <div class="mt-5 text-xs text-slate-500"style ="display:flex;">

                                <x-base.lucide

                                            class="h-10 w-10 text-warning fontsi"

                                            icon="Monitor"

                                        />

                                Processing Complain</div>

                                <div class="mt-1.5 flex items-center">

                                    <div class="text-base">0</div>

                                </div>

                                

                                <div class="mt-5 text-xs text-slate-500" style="display:flex;">

                                <x-base.lucide

                                            class="h-10 w-10 text-warning fontsi"

                                            icon="FileMinus"

                                        />

                                    Open Complain

                                </div>

                                <div class="mt-1.5 flex items-center">

                                    <div class="text-base">{{ $openComplaintCount}}</div>

                                </div>

                                <!--Pending New-->

                                <div class="mt-5 text-xs text-slate-500" style="display:flex;">

                                <x-base.lucide

                                            class="h-10 w-10 text-warning fontsi"

                                            icon="FileText"

                                        />

                                     Pending Complain

                                </div>

                                <div class="mt-1.5 flex items-center">

                                    <div class="text-base">{{$totalComplaints}}</div>

                                </div>

                                <!--Pending End-->

                                <div class="mt-5 text-xs text-slate-500" style="display:flex;">

                                <x-base.lucide

                                            class="h-10 w-10 text-warning fontsi"

                                            icon="Pause"

                                        />

                                        Hold Complain</div>

                                        

                                <div class="mt-1.5 flex items-center mr-50">

                                    <div class="text-base"style="margin-left= 15px">{{ $totalHoldComplaints }}</div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- END: General Report -->

                <!-- BEGIN: Visitors -->

                <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-4 xl:col-span-3">

                    <div class="intro-y flex h-10 items-center">

                    </div>

                    <div

                        class="intro-y relative mt-5 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70">

                        <div class="box p-5">

                            <div class="flex items-center">

                                Total AMC

                                <x-base.menu class="ml-auto">

                                    <x-base.menu.button

                                        class="-mr-2 block h-5 w-5"

                                        href="#"

                                        as="a"

                                    >

                                        <x-base.lucide

                                            class="h-5 w-5 text-slate-500"

                                            icon="MoreVertical"

                                        />

                                    </x-base.menu.button>

                                    <x-base.menu.items class="w-40">

                                        <x-base.menu.item>

                                            <x-base.lucide

                                                class="mr-2 h-4 w-4"

                                                icon="FileText"

                                            />

                                            Export

                                        </x-base.menu.item>

                                        <x-base.menu.item>

                                            <x-base.lucide

                                                class="mr-2 h-4 w-4"

                                                icon="Settings"

                                            />

                                            Settings

                                        </x-base.menu.item>

                                    </x-base.menu.items>

                                </x-base.menu>

                            </div>

                            <div class="mt-2 text-2xl font-medium">{{ $totalAmc }}</div>

                            <div class="mt-4 flex border-b border-slate-200 pb-2">

                                <div class="text-xs text-slate-500">Page views per second</div>

                                <x-base.tippy

                                    class="ml-auto flex cursor-pointer text-xs font-medium text-success"

                                    as="div"

                                    content="49% Lower than last month"

                                >

                                    <!-- 49% -->

                                    <x-base.lucide

                                        class="ml-0.5 h-4 w-4"

                                        icon="ChevronUp"

                                    />

                                </x-base.tippy>

                            </div>

                            <div class="broder-slate-200 mt-2 border-b">

                                <div class="-mb-1.5 -ml-2.5">

                                    <x-report-bar-chart height="h-[79px]" />

                                </div>

                            </div>

                            <div class="mt-4 mb-2 flex border-b border-slate-200 pb-2 text-xs text-slate-500">

                                <div>AMC Page</div>

                                <div class="ml-auto">Active Users</div>

                            </div>

                            

                            <div class="mt-1.5 flex">

                                <div>Up Coming AMC</div>

                                <div class="ml-auto">{{ $totalUpCommingAMC }}</div>

                            </div>

                            <div class="mt-1.5 flex">

                                <div>Pending AMC</div>

                                <div class="ml-auto">{{ $totalUpCommingAMC }}</div>

                            </div>

                             @php 

                                     $getExpireDatacount = DB::table('amcs')

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

                                    ->count();

                                    @endphp

                            <div class="mt-1.5 flex">

                                <div>Expire AMC</div>

                                <div class="ml-auto">{{$getExpireDatacount}}</div>

                            </div>

                            <x-base.button

                                class="mt-4 w-full border-dashed px-2 py-1"

                                variant="outline-secondary"

                            >

                                <a href="/amc">Real Time Report</a>

                            </x-base.button>

                        </div>

                    </div>

                </div>

                <!-- END: Visitors -->

                <!-- BEGIN: Users By Age -->

                <div class="col-span-12 mt-2 sm:col-span-6 lg:col-span-4 lg:mt-6 xl:col-span-3 xl:mt-2">

                    <div class="intro-y flex h-10 items-center">

                        <a

                            class="ml-auto flex items-center text-primary mr-2"

                            href=""

                        >

                            <x-base.lucide

                                class="mr-3 h-4 w-4"

                           
                        </a>   
                        <a  href="{{ route('create.complaint') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Complaint</a>
                    
                    <a  href="{{ route('create.customer.form') }}" class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Customer</a> 
                        

                    </div>

                    <div

                        class="intro-y relative mt-5 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70">

                        <x-base.tab.group class="box p-5">

                            <x-base.tab.list

                                class="mx-auto w-4/5 rounded-md bg-slate-100 dark:bg-black/20"

                                variant="pills"

                            >

                                <x-base.tab

                                    id="active-users-tab"

                                    selected

                                >

                                    <x-base.tab.button

                                        class="w-full py-1.5 px-2"

                                        as="button"

                                    >

                                    Attendance

                                    </x-base.tab.button>

                                </x-base.tab>

                            </x-base.tab.list>

                            <x-base.tab.panels class="mt-6" style="margin-top: 5px;">

                                <x-base.tab.panel

                                    id="active-users"

                                    selected

                                >

                                    <div class="relative">
                                        <div id="donutchart" style="width: 100%; text-align: center;"></div>
                                        <!-- <x-report-donut-chart

                                            class="mt-3"

                                            height="h-[208px]"

                                        />

                                        <div

                                            class="absolute top-0 left-0 flex h-full w-full flex-col items-center justify-center">

                                            <div class="text-2xl font-medium">{{ $totalTechnician}}</div>

                                            <div class="mt-0.5 text-slate-500">Active Users</div>

                                        </div> -->

                                    </div>

                                    <div class="mx-auto mt-5 w-52 sm:w-auto">

                                        <div class="flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>

                                            <span class="truncate">Total Technicians</span>

                                            <span class="ml-auto font-medium">{{ $totalTechnician}}</span>

                                        </div>

                                        <div class="mt-4 flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>

                                            <span class="truncate">Total Check-In</span>

                                            <span class="ml-auto font-medium"><span id="totalchheckin">{{ $checkinCounts}}</span></span>

                                        </div>

                                        <div class="mt-4 flex items-center">

                                            <div class="mr-3 h-2 w-2 rounded-full bg-warning"></div>

                                            <span class="truncate">Total Check-Out</span>

                                            <span class="ml-auto font-medium"><span id="totalAbsent"> {{ $totalAbsent}}</span></span>

                                        </div>

                                    </div>

                                </x-base.tab.panel>

                            </x-base.tab.panels>

                        </x-base.tab.group>

                    </div>

                </div>


                <!-- END: Users By Age -->

                <!-- BEGIN: General Report -->

                <div class="col-span-6 mt-8">

                    <div class="intro-y flex h-10 items-center">
                    <h2 class="mr-5 truncate text-lg font-medium">Complaints</h2>
                        

                        <!-- <a

                            class="ml-auto flex items-center text-primary"

                            href=""

                        >

                            <x-base.lucide

                                class="mr-3 h-4 w-4"

                                icon="RefreshCcw"

                            /> Reload Data

                        </a> -->

                    </div>

                    <div class="mt-5 grid grid-cols-12 gap-6">

                        {{-- <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                            <div @class([

                                'relative zoom-in',

                                'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',

                            ])>

                            <a href={{ route('technician') }}>

                                <div class="box p-5">

                                    <div class="flex">

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-primary"

                                            icon="users"

                                        />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$totalTechnician}}</div>

                                    <div class="mt-1 text-base text-slate-500">Total Technicians</div>

                                </div>

                            </a>

                            </div>

                        </div> --}}

                        {{-- <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                            <div @class([

                                'relative zoom-in',

                                'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',

                            ])>

                            <a href={{ route('in.tech') }}>

                                <div class="box p-5">

                                    <div class="flex">

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-primary"

                                            icon="users"

                                        />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$toalCheckIn}}</div>

                                    <div class="mt-1 text-base text-slate-500">Total Check-in Technicians</div>

                                </div>

                            </a>

                            </div>

                        </div> --}}

                        {{-- <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                            <div @class([

                                'relative zoom-in',

                                'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',

                            ])>

                             <a href={{ route('customer.list') }}>

                                <div class="box p-5">

                                    <div class="flex">

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-pending"

                                            icon="users"

                                        />

                                        <div class="ml-auto">

                                            <x-base.tippy

                                                class="flex cursor-pointer items-center rounded-full bg-danger py-[3px] pl-2 pr-1 text-xs font-medium text-white"

                                                as="div"

                                                content="2% Lower than last month"

                                            >

                                                2%

                                                <x-base.lucide

                                                    class="ml-0.5 h-4 w-4"

                                                    icon="ChevronDown"

                                                />

                                            </x-base.tippy>

                                        </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$totalCustomers}}</div>

                                   <div class="mt-1 text-base text-slate-500">Total Customers</div>

                                </div>

                            </a>

                            </div>

                        </div> --}}

                        <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-6">

                            <div @class([

                                'relative zoom-in',

                                'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',

                            ])>

                            <a href={{ route('list.complaint') }}>

                                <div class="box p-5">

                                    <div class="flex">

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-warning"

                                            icon="FileMinus"

                                        />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{ $openComplaintCount}}</div>

                                    <div class="mt-1 text-base text-slate-500">

                                        <div class="mt-1 text-base text-slate-500">Open Complains</div>

                                    </div>

                                </div></a>

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

                                    <x-base.lucide

                                        class="h-[28px] w-[28px] text-warning"

                                        icon="Pause"

                                    />

                                    </div>
                                    @php 

                                    $complaintscount = DB::table('jobs')

                                        ->where('status', 'Hold')

                                        ->count();

                                    @endphp

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$complaintscount}}</div>

                                    <div class="mt-1 text-base text-slate-500">

                                        <div class="mt-1 text-base text-slate-500">Hold Complains</div>

                                    </div>

                                </div></a>

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

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-warning"

                                                icon="Monitor"

                                            />

                                    </div>

                                     @php 

                                    $complaintscount = DB::table('jobs')

                                        ->where('status', 'Pending')

                                        ->count();

                                    @endphp

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$complaintscount}}</div>

                                    <div class="mt-1 text-base text-slate-500">

                                        <div class="mt-1 text-base text-slate-500">Pending complaint
</div>

                                    </div>

                                </div></a>

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

                                <a href={{ route('list.complaint') }}>

                                <div class="box p-5">

                                    <div class="flex">

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-warning"

                                            icon="ThumbsUp"

                                        />

                                        {{-- <div class="ml-auto">

                                            <x-base.tippy

                                                class="flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"

                                                as="div"

                                                content="22% Higher than last month"

                                            >

                                                22%

                                                <x-base.lucide

                                                    class="ml-0.5 h-4 w-4"

                                                    icon="ChevronUp"

                                                />

                                            </x-base.tippy>

                                        </div> --}}

                                    </div>
                                     @php 

                                    $complaintscount = DB::table('jobs')

                                        ->where('status', 'Complete')

                                        ->count();

                                    @endphp

                                    <div class="mt-6 text-3xl font-medium leading-8">{{$complaintscount}}</div>

                                    <div class="mt-1 text-base text-slate-500">

                                     <div class="mt-1 text-base text-slate-500">Complete Complains</div>



                                    </div>

                                </div>

                            </a>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-span-6 mt-8">

                    <div class="intro-y flex h-10 items-center">
                    <h2 class="mr-5 truncate text-lg font-medium">AMC</h2>
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

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-success"

                                            icon="aperture"

                                        />

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

                                    <x-base.lucide

                                        class="h-[28px] w-[28px] text-success"

                                        icon="ArrowRight"

                                    />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{ $totalUpCommingAMC }}</div>

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

                                    <x-base.lucide

                                        class="h-[28px] w-[28px] text-success"

                                        icon="Clock"

                                    />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{ $totalUpCommingAMC }}</div>

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

                                        <x-base.lucide

                                            class="h-[28px] w-[28px] text-success"

                                            icon="RefreshCw"

                                        />

                                    </div>

                                    <div class="mt-6 text-3xl font-medium leading-8">{{ $getExpireDatacount }}</div>

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

<!-- Service section -->

               <div class="col-span-12 mt-6 md:col-span-6 lg:col-span-3">
                    <div class="items-center block h-10 intro-y sm:flex">
                        <h2 class="mr-5 text-lg font-medium truncate">Ac fitting/Refitting</h2>
                    </div>
                    <div class="p-5 mt-12 intro-y box sm:mt-5">
                        <div
                            class="flex pb-3 mb-3 border-b border-dashed border-slate-200 text-slate-500 dark:border-darkmode-300">
                            <div>Parameters</div>
                            <div class="ml-auto">Report Values</div>
                        </div>
                        <div class="flex items-center mb-5">
                            <div class="flex items-center">
                                <div>Count's Of Ac fitting/Refitting</div>
                            </div>
                            <div class="ml-auto">{{$categoryCount}}</div>
                        </div>
                        <a href="/list-job">
                        <x-base.button
                            class="relative justify-start w-full mb-2 border-dashed border-slate-300 dark:border-darkmode-300"
                            variant="outline-secondary"
                        >
                            <span class="mr-5 truncate">View Full Report</span>
                            <span
                                class="absolute right-0 top-0 bottom-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center"
                            >
                                <x-base.lucide
                                    class="w-4 h-4"
                                    icon="ArrowRight"
                                />
                            </span>
                        </x-base.button>
                        </a>
                    </div>
                </div>
                <div class="col-span-12 mt-6 md:col-span-6 lg:col-span-3">
                    <div class="items-center block h-10 intro-y sm:flex">
                        <h2 class="mr-5 text-lg font-medium truncate">Copper piping</h2>
                    </div>
                    <div class="p-5 mt-12 intro-y box sm:mt-5">
                        <div
                            class="flex pb-3 mb-3 border-b border-dashed border-slate-200 text-slate-500 dark:border-darkmode-300">
                            <div>Parameters</div>
                            <div class="ml-auto">Report Values</div>
                        </div>
                        <div class="flex items-center mb-5">
                            <div class="flex items-center">
                                <div>Count's Of Copper piping</div>
                            </div>
                            <div class="ml-auto">{{$categoryCount}}</div>
                        </div>
                        <a href="/list-job">
                        <x-base.button
                            class="relative justify-start w-full mb-2 border-dashed border-slate-300 dark:border-darkmode-300"
                            variant="outline-secondary"
                        >
                            <span class="mr-5 truncate">View Full Report</span>
                            <span
                                class="absolute right-0 top-0 bottom-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center"
                            >
                                <x-base.lucide
                                    class="w-4 h-4"
                                    icon="ArrowRight"
                                />
                            </span>
                        </x-base.button>
                        </a>
                    </div>
                </div>
                <div class="col-span-12 mt-6 md:col-span-6 lg:col-span-3">
                    <div class="items-center block h-10 intro-y sm:flex">
                        <h2 class="mr-5 text-lg font-medium truncate">Ac Check</h2>
                    </div>
                    <div class="p-5 mt-12 intro-y box sm:mt-5">
                        <div
                            class="flex pb-3 mb-3 border-b border-dashed border-slate-200 text-slate-500 dark:border-darkmode-300">
                            <div>Parameters</div>
                            <div class="ml-auto">Report Values</div>
                        </div>
                        <div class="flex items-center mb-5">
                            <div class="flex items-center">
                                <div>Count's Of Ac Check</div>
                            </div>
                            <div class="ml-auto">{{$categoryCount}}</div>
                        </div>
                        <a href="/list-job">
                        <x-base.button
                            class="relative justify-start w-full mb-2 border-dashed border-slate-300 dark:border-darkmode-300"
                            variant="outline-secondary"
                        >
                            <span class="mr-5 truncate">View Full Report</span>
                            <span
                                class="absolute right-0 top-0 bottom-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center"
                            >
                                <x-base.lucide
                                    class="w-4 h-4"
                                    icon="ArrowRight"
                                />
                            </span>
                        </x-base.button>
                        </a>
                    </div>
                </div>
                <div class="col-span-12 mt-6 md:col-span-6 lg:col-span-3">
                    <div class="items-center block h-10 intro-y sm:flex">
                        <h2 class="mr-5 text-lg font-medium truncate">Ac Service</h2>
                    </div>
                    <div class="p-5 mt-12 intro-y box sm:mt-5">
                        <div
                            class="flex pb-3 mb-3 border-b border-dashed border-slate-200 text-slate-500 dark:border-darkmode-300">
                            <div>Parameters</div>
                            <div class="ml-auto">Report Values</div>
                        </div>
                        <div class="flex items-center mb-5">
                            <div class="flex items-center">
                                <div>Count's Of Ac Service</div>
                            </div>
                            <div class="ml-auto">{{$categoryCount}}</div>
                        </div>
                        <a href="/list-job">
                        <x-base.button
                            class="relative justify-start w-full mb-2 border-dashed border-slate-300 dark:border-darkmode-300"
                            variant="outline-secondary"
                        >
                            <span class="mr-5 truncate">View Full Report</span>
                            <span
                                class="absolute right-0 top-0 bottom-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center"
                            >
                                <x-base.lucide
                                    class="w-4 h-4"
                                    icon="ArrowRight"
                                />
                            </span>
                        </x-base.button>
                        </a>
                    </div>
                </div>
                <!-- END: Visitors -->
               

<!-- Table Css 1 -->

    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <x-base.dialog id="delete-confirmation-modal">
        <x-base.dialog.panel>
            <div class="p-5 text-center">
                <x-base.lucide
                    class="mx-auto mt-3 h-16 w-16 text-danger"
                    icon="XCircle"
                />
                <div class="mt-5 text-3xl">Are you sure?</div>
                <div class="mt-2 text-slate-500">
                    Do you really want to delete these records? <br />
                    This process cannot be undone.
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <x-base.button
                    class="mr-1 w-24"
                    data-tw-dismiss="modal"
                    type="button"
                    variant="outline-secondary"
                >
                    Cancel
                </x-base.button>
                <x-base.button
                    class="w-24"
                    type="button"
                    variant="danger"
                >
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

                    

<div class="intro-y relative mt-12 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70 sm:mt-5">

    

        <div class="intro-x flex h-10 items-center">

            <h2 class="mr-5 truncate text-lg font-medium">

                Open Complaints

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

            <x-base.table.tbody >

                    @foreach ($openComplaintList as $row)



                    @php

                        $getJobData=DB::table('jobs')->where('complaint_id',$row->id)->count();

                        //$getJobData=0;

                    @endphp

                    <x-base.table.tr class="intro-x">

                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                            {{ $row->ref_no }}

                         </x-base.table.td>

                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                           {{ $row->customer->name ?? '' }}

                        </x-base.table.td>



                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                            {{ $row->created_at }}

                         </x-base.table.td>

                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                            <!-- @if ($getJobData == 0)

                             <a class='btn btn-sm bg-warning text-white' href='{{ route('job.create.form',['Id'=>$row->id ]) }}' >Create-Job</a>

                            @else

                            <div class="flex items-center justify-center text-success">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                                Job-Created

                            </div>

                            @endif -->



                        

                            <!-- <a

                                class="mr-3 flex items-center"

                                href="{{ route('edit.complaint',$row->id) }}"

                            >

                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]: disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning mb-2 mr-1 mb-2 mr-1"><i data-lucide="share" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                            </a> 



                            <a

                                class="flex items-center text-danger"

                                href="{{ route('del.complaint',$row->id) }}"

                            >

                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger mb-2 mr-1 mb-2 mr-1"><i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                            </a> -->

                            <!--<a-->

                            <!--    class="mr-3 flex items-center"-->

                            <!--    href="{{ route('edit.complaint',$row->id) }}"-->

                            <!-->

                            <!--    <x-base.lucide-->

                            <!--        class="mr-1 h-4 w-4"-->

                            <!--        icon="CheckSquare"-->

                            <!--    />-->

                            <!--    Edit-->

                            <!--</a>-->

                            <a href="{{ route('edit.complaint',$row->id) }}">

                            <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-dark border-dark text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="edit" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                            </a>

                            <!-- <a class='btn bg-danger btn-sm text-white mt-2' href='{{ route('del.complaint',$row->id) }}'>Delete</a> -->


                            <a data-tw-merge data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1">
                                    <i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i>
                                </button>
                            </a>


                                     <!-- BEGIN: Modal Content -->
                                                    <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-preview" class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
                                                <div class="w-[90%] mx-auto bg-white relative rounded-md shadow-md transition-[margin-top,transform] duration-[0.4s,0.3s] -mt-16 group-[.show]:mt-16 group-[.modal-static]:scale-[1.05] dark:bg-darkmode-600 sm:w-[460px]">
                                                <div class="p-5 text-center">
                                                <i data-lucide="x-circle" width="24" height="24" class="stroke-1.5 w-16 h-16 mx-auto mt-3 text-danger w-16 h-16 mx-auto mt-3 text-danger"></i>


                                                <div class="mt-5 text-3xl">Are you sure?</div>
                                                <div class="mt-2 text-slate-500">
                                                    Do you really want to delete these records? <br />
                                                    This process cannot be undone.
                                                </div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button data-tw-merge data-tw-dismiss="modal" type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&amp;:hover:not(:disabled)]:bg-secondary/20 [&amp;:hover:not(:disabled)]:dark:bg-darkmode-100/10 w-24 mr-1 w-24 mr-1">Cancel</button>
                                                
                                                <a href="{{ route('del.complaint', $row->id) }}">
                                                <button data-tw-merge type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white dark:border-danger w-24 w-24">Delete</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Modal Content -->

                       
                             <!--@if ($getJobData == 0)-->
                             <!--   <a href="{{ route('job.create.form',['Id'=>$row->id ]) }}">-->
                             <!--       <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">-->
                             <!--       <i data-lucide="file" width="15" height="15" class="stroke-1.5 h-5 w-8"></i>Create-Job</button>-->
                             <!--   </a>-->
    
                             <!--   @endif-->
                        

                            

                         </x-base.table.td>



                    </x-base.table.tr>

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

                    

                    <div class="intro-y relative mt-12 before:absolute before:inset-x-0 before:mx-auto before:mt-3 before:h-full before:w-[90%] before:rounded-md before:bg-slate-50 before:shadow-[0px_3px_20px_#0000000b] before:content-[''] before:dark:bg-darkmode-400/70 sm:mt-5">

                        

                        

                        <div class="intro-x flex h-10 items-center background-box text-center">

                            <h2 class="mr-5 truncate text-lg font-medium">Pending Complaints</h2>

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

                                            $getJobData=DB::table('jobs')->where('complaint_id',$row->id)->count();

                                            $getJobData=0;

                                        @endphp -->

                                        <x-base.table.tr class="intro-x">

                                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                            {{ $row->name }}

                                             </x-base.table.td>

                                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                               <!-- {{ $row->customer->name ?? 'N/A' }} -->
                                               <a href='{{ route('job.invoice',$row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>

                                            </x-base.table.td>



                                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                                {{ $row->created_at }}

                                             </x-base.table.td>

                                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >



                                                <!--<a-->

                                                <!--    class="mr-3 flex items-center"-->

                                                <!--    href="{{ route('edit.complaint',$row->id) }}"-->

                                                <!-->

                                                <!--    <x-base.lucide-->

                                                <!--        class="mr-1 h-4 w-4"-->

                                                <!--        icon="CheckSquare"-->

                                                <!--    />-->

                                                <!--    Edit-->

                                                <!--</a>-->

                                                <!-- <a href="{{ route('edit.complaint',$row->id) }}">

                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-dark border-dark text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="edit" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                </a>

                                                

                                                <a href="{{ route('del.complaint',$row->id) }}">

                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-1 px-1 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-denger text-white dark:bg-darkmode-800 dark:border-transparent dark:text-slate-300 [&amp;:hover:not(:disabled)]:dark:dark:bg-darkmode-800/70 mb-2 mr-1 mb-2 mr-1"><i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-5 h-5 w-5"></i></button>

                                                </a> -->

                                                
                                            <a

                                            class="flex items-center text-success"

                                            href="{{ route('job.assign_technician',['id'=>$row->id]) }}"

                                            >

                                            <x-base.lucide

                                                class="mr-1 h-4 w-4"

                                                icon="CheckSquare"

                                            />

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

    background-color: #164E63; /* Updated color */

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

    border-bottom: 2px solid #164E63; /* Updated color */

}



.content-table tbody tr.active-row {

    font-weight: bold;

    color: #164E63; /* Updated color */

}

</style>

 <!-- END: Weekly Top Products -->

                <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2">

                    <div class="intro-x flex h-10 items-center">

                                <h2 class="mr-5 truncate text-lg font-medium">

                                    Inprocess Complaints

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

                                        Action

                                    </x-base.table.th>



                                </x-base.table.tr>

                            </x-base.table.thead>

                            <x-base.table.tbody >

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

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                           {{ $row->name }}

                                        </x-base.table.td>

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                          <a href='{{ route('job.invoice',$row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>

                                        </x-base.table.td>

                                        <!--<x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >-->

                                        <!--   {{ $row->product }}-->

                                        <!--</x-base.table.td>-->

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                           {{ $row->job_category }}

                                        </x-base.table.td>

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                            <!--{{ $row->address }} {{ $row->city }} {{ $row->postal_code }}-->

                                             @if($customercount > 0)

                                @php

                                 $customerlocation = DB::table('customer_details')

                                                ->where('id', $row->address)

                                                ->first();

                                 $locatyion = $customerlocation->location_type;

                                @endphp

                                @else

                                @php $locatyion =''; @endphp

                                @endif

                                {{$locatyion}}

                                        </x-base.table.td>

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                           {{ $row->supervisor_name }}

                                        </x-base.table.td>

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >



                                           <div class="flex items-center text-danger">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                                            {{ $row->status }}



                                            </div>



                                            @if ($row->technician_id!='0')

                                                @php

                                                    $technicians=DB::table('technicians')->where('id',$row->technician_id)->first();

                                                        if(empty($getIn))

                                                        {

                                                            echo "(".$technicians->name.")";

                                                        }



                                                @endphp

                                           @endif

                                        </x-base.table.td>

                                        <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >



                                            <!-- <a class='btn btn-success btn-sm' href="{{ route('job.assign_technician',['id'=>$row->id]) }}"> Assign / Change Job</a> -->



                                            <a

                                                    class="flex items-center text-success"

                                                    href="{{ route('job.assign_technician',['id'=>$row->id]) }}"

                                                >

                                                <x-base.lucide

                                                        class="mr-1 h-4 w-4"

                                                        icon="CheckSquare"

                                                    />

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

    <div class="grid grid-cols-12 gap-6">

    <div class="col-span-12 mt-6 xl:col-span-8">

        <div class="intro-y block h-10 items-center sm:flex">

            <h2 class="mr-5 truncate text-lg font-medium">Official Store</h2>

            <div class="relative mt-3 text-slate-500 sm:ml-auto sm:mt-0">

                <x-base.lucide

                    class="absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4"

                    icon="MapPin"

                />

                <x-base.form-input

                    class="!box pl-10 sm:w-56"

                    type="text"

                    placeholder="Filter by city"

                />

            </div>

        </div>

        @php

        $loctechnicount =DB::table('attendances')->where('check_status','In')->select('technician_id')->groupby('technician_id')->count();

        $loctechnician =DB::table('attendances')->where('check_status','In')->select('technician_id')->groupby('technician_id')->get();
        $loc = "";
        @endphp

        @foreach ($loctechnician as $row4777)
            @php
            $techid  = $row4777->technician_id;
            
            $technician =DB::table('attendances')->where('technician_id',$techid)->where('check_status','In')->orderby('id','DESC')->first();

            $techniciancount =DB::table('technicians')->where('id',$techid)->count();

            if($techniciancount > 0)
            {
                $technicianname =DB::table('technicians')->where('id',$techid)->first();
                $tname = '<b>'.$technicianname->name.'</b><br>'.$technician->address;
            }
            else
            {
                $tname = '<b>SK Enterprise'.'</b><br>'.$technician->address;
            }

            $address = str_replace("'", "", $technician->address);
            $name = str_replace("'", "", $tname);;

            $loc .='{"DisplayText": "'.$name.'", "ADDRESS": "'.$address.'" , "LatitudeLongitude": "'.$technician->latitude.','.$technician->longitude.'", "MarkerId": "Customer"},';
           
            @endphp
        @endforeach

        @php $location = substr_replace($loc, "", -1); @endphp
 
        <div class="intro-y box mt-12 p-5 sm:mt-5">

            <div>

                {{$loctechnicount}} Official stores in 21 countries, click the marker to see

                location details.

            </div>

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

         

        <!-- <div class="mt-5">

            @foreach (array_slice($fakers, 0, 4) as $faker)

                <div class="intro-y">

                    <div class="box zoom-in mb-3 flex items-center px-4 py-4">

                        <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-md">

                            <img

                                src="{{ Vite::asset($faker['photos'][0]) }}"

                                alt="Midone Tailwind HTML Admin Template"

                            />

                        </div>

                        <div class="ml-4 mr-auto">

                            <div class="font-medium">{{ $faker['users'][0]['name'] }}</div>

                            <div class="mt-0.5 text-xs text-slate-500">

                                {{ $faker['dates'][0] }}

                            </div>

                        </div>

                        <div

                            class="cursor-pointer rounded-full bg-success px-2 py-1 text-xs font-medium text-white">

                            137 Sales

                        </div>

                    </div>

                </div>

            @endforeach

        

        </div> -->

        @php

        $tech_new = DB::table('technicians')->select(array('technicians.id',DB::raw('COUNT(jobs.id) as count')))->where('technicians.id', '!=', 0)->join('jobs', 'jobs.technician_id', '=', 'technicians.id')->where('jobs.status','Complete')->groupby('technicians.id')->orderby('count', 'desc')->limit(5)->get();

        $i = 0;
        @endphp
          
        <div class="mt-5">
             @foreach ($tech_new as $row44)
                @php
                    $i ++ ;
                    $technicianscount = DB::table('technicians')->where('id', $row44->id)->count();
                @endphp
                @if($technicianscount > 0)
                @php
                    $technicians = DB::table('technicians')->where('id', $row44->id)->first();
                @endphp
                <div class="intro-y">
                    <div class="box zoom-in mb-3 flex items-center px-4 py-4">
                        <div class="image-fit h-10 w-10 flex-none overflow-hidden rounded-md">
                            <img
                            class="rounded-full"
                            src="{{ asset('technician_images/'.$technicians->profile_image)}}"
                            alt="{{ $technicians->name }}"
                        />
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium">{{ $technicians->name }}</div>
                            <div class="mt-0.5 text-xs text-slate-500">
                                {{ $technicians->user_name }}
                            </div>
                        </div>
                        <div
                            class="cursor-pointer rounded-full bg-success px-2 py-1 text-xs font-medium text-white">
                            {{$row44->count}}
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
           
            <a
                class="intro-y block w-full rounded-md border border-dotted border-slate-400 py-4 text-center text-slate-500 dark:border-darkmode-300"
                href="{{ route('technician.index') }}"
            >
                View More
            </a>
        </div>

    </div>


    </div>

    

            </div>

        </div>

    </div>

    

@endsection

@push('script')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&sensor=true" type="text/javascript"></script>

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
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                geocoder.geocode({ 'address': people["Address"] }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
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
                    }
                    else {
                        alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                    }
                });
            }
            else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false,               // cant drag it
                    html: people["DisplayText"]    // Content display on marker click
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

       var slected_date=$(this).val();

            jQuery.ajax({

                 url: '{{ route('change-checkin-count') }}',

                 type: "POST",

                 data: {

                        _token:"{{ csrf_token() }}",

                        date:slected_date

                      },

                  success:function(data){

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>

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
      google.charts.load("current", {packages:["corechart"]});
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
          legend:'none',
            width: '100%',
            height: '100%',
            colors: ['#164e63', '#d97706','#f59e0b'],
            chartArea: {
                height: "100%",
                width: "100%"
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

<script>



@endpush

