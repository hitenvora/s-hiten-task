@extends('../layouts/side-menu')



@section('subhead')
    <title>Complain Detail</title>
@endsection



@section('subcontent')
 
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Profile Layout
            </h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        {{-- <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-5.jpg"> --}}
                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $jobs->name }}</div>
                        <div class="text-slate-500">{{ $jobs->phone_no }}</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Complaint Details</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"><b>Complaint ID:- </b>&nbsp; {{ $jobs->job_ref_no }} </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Priority:-</b>&nbsp; {{ $jobs->priority }} </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Job Category:-</b>&nbsp; {{ $jobs->job_category }} </div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Payment Details</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"><b>Payment Type:- </b>&nbsp; {{ $jobs->payment_type }} </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Bill Amount:-</b>&nbsp; {{ $jobs->bill_amount }} </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Recieve Amount:-</b>&nbsp; {{ $jobs->received_amount }} </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Profile Info -->
        <div class="tab-content mt-5">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab" style="width: 1599px;">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Latest Uploads -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Technician
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="more-horizontal" data-lucide="more-horizontal" class="lucide lucide-more-horizontal w-5 h-5 text-slate-500"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        {{-- <li> <a href="javascript:;" class="dropdown-item">All Files</a> </li> --}}
                                    </ul>
                                </div>
                            </div>
                            {{-- <button class="btn btn-outline-secondary hidden sm:flex">All Files</button> --}}
                        </div>
                        @php
                            $technician = DB::table('technicians')->where('id',$jobs->technician_id)->first();
                        @endphp
                        <div class="p-5">
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                <div class="truncate sm:whitespace-normal flex items-center"><b>Name:- </b>&nbsp; {{ $technician->name }} </div>
                                <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Mobile No.:-</b>&nbsp; {{ $technician->mobile_no }} </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Latest Uploads -->
                    <!-- BEGIN: Work In Progress -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                Supervisor
                            </h2>
                            {{-- <ul class="nav nav-link-tabs w-auto ml-auto hidden sm:flex" role="tablist">
                                <li id="work-in-progress-new-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-5 active" data-tw-target="#work-in-progress-new" aria-controls="work-in-progress-new" aria-selected="true" role="tab"> New </a> </li>
                                <li id="work-in-progress-last-week-tab" class="nav-item" role="presentation"> <a href="javascript:;" class="nav-link py-5" data-tw-target="#work-in-progress-last-week" aria-selected="false" role="tab"> Last Week </a> </li>
                            </ul> --}}
                        </div>
                        <div class="p-5">
                            {{-- @php
                                $supervisor = DB::table('supervisors')->where('id',$jobs->supervisor_id)->first();
                            @endphp --}}
                            <div class="p-5">
                                <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                                    <div class="truncate sm:whitespace-normal flex items-center"><b>Name:- </b>&nbsp; {{ $jobs->supervisor_name }} </div>
                                    <div class="truncate sm:whitespace-normal flex items-center mt-3"><b>Mobile No.:-</b>&nbsp; {{ $jobs->supervisor_mobile_no }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- BEGIN: Delete Confirmation Modal -->

  

@endsection
