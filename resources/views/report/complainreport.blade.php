@extends('../layouts/side-menu')



@section('subhead')
    <title>Complain Report</title>
@endsection



@section('subcontent')
    <!-- BEGIN: General Report -->

    <div class="col-span-12 mt-4">
        <div class="" style="display: flex;justify-content: space-between">
            <div></div>
            <div class="" style="display: flex; justify-content: flex-end;">
                <div>
                    <form action='{{ route('create.report.form.complainfilter') }}' method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="input-form mt-3">
                                            <label for="start-date">From Date</label>
                                            <input name="from_date" type="date" id="from_date" required="required"
                                                value="{{ session()->get('fromdate') !== null ? session()->get('fromdate') : '' }}"
                                                class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-form mt-3">
                                            <label for="end-date">To Date</label>
                                            <input name="to_date" type="date" id="to_date" required="required"
                                                value="{{ session()->get('todate') != null ? session()->get('todate') : '' }}"
                                                class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-form mt-3">
                                            <button type="submit"
                                                class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div>
                    <form action='{{ route('create.report.form.resetfilter') }}' method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <button type="submit"
                            class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5"
                            style="margin-top: 33px; margin-left: 10px;">Clear</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="intro-y flex h-10 items-center">

            <h2 class="mr-5 truncate text-lg font-medium">General Report</h2>
            <a class="ml-auto flex items-center text-primary" href="">

                <x-base.lucide class="mr-3 h-4 w-4" icon="RefreshCcw" /> Reload Data

            </a>

        </div> --}}

        <div class="mt-5 grid grid-cols-12 gap-6">

            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                <div @class([
                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                ])>

                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-primary" icon="ShoppingCart" />
                        </div>

                        @php
                            if (session()->get('fromdate') != '' && session()->get('todate')) {
                                $complaintscount = DB::table('complaints')
                                    ->join('users', 'complaints._customer_id', '=', 'users.id')
                                    ->join(
                                        'customer_details',
                                        'complaints._customer_address_id',
                                        '=',
                                        'customer_details.id',
                                    )
                                    ->select('complaints.*', 'users.name', 'customer_details.location_type')
                                    ->whereBetween('complaints.created_at', [
                                        session()->get('fromdate') . ' 00:00:00',
                                        session()->get('todate') . ' 23:59:59',
                                    ])
                                    ->count();
                            } else {
                                $complaintscount = DB::table('complaints')
                                    ->join('users', 'complaints._customer_id', '=', 'users.id')
                                    ->join(
                                        'customer_details',
                                        'complaints._customer_address_id',
                                        '=',
                                        'customer_details.id',
                                    )
                                    ->select('complaints.*', 'users.name', 'customer_details.location_type')
                                    ->count();
                            }

                        @endphp

                        {{-- <div class="mt-6 text-3xl font-medium leading-8">{{ $complaintscount }}</div> --}}
                        <div class="mt-6 text-3xl font-medium leading-8">{{ $jobs->count() }}</div>

                        <div class="mt-1 text-base text-slate-500">Total Complain</div>

                    </div>

                </div>

            </div>

            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                <div @class([
                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                ])>

                    <div class="box p-5">

                        <div class="flex">

                            <x-base.lucide class="h-[28px] w-[28px] text-pending" icon="CreditCard" />

                            <div class="ml-auto">

                                @php
                                    if (session()->get('fromdate') != '' && session()->get('todate')) {
                                        $complaintscount = DB::table('complaints')
                                            ->join('users', 'complaints._customer_id', '=', 'users.id')
                                            ->join(
                                                'customer_details',
                                                'complaints._customer_address_id',
                                                '=',
                                                'customer_details.id',
                                            )
                                            ->select('complaints.*', 'users.name', 'customer_details.location_type')
                                            ->whereBetween('complaints.created_at', [
                                                session()->get('fromdate') . ' 00:00:00',
                                                session()->get('todate') . ' 23:59:59',
                                            ])
                                            ->count();
                                    } else {
                                        $complaintscount = DB::table('complaints')
                                            ->join('users', 'complaints._customer_id', '=', 'users.id')
                                            ->join(
                                                'customer_details',
                                                'complaints._customer_address_id',
                                                '=',
                                                'customer_details.id',
                                            )
                                            ->select('complaints.*', 'users.name', 'customer_details.location_type')
                                            ->count();
                                    }
                                @endphp
                                @php

                                    $amccount = 0;
                                    $balance = 0;
                                    if (session()->get('fromdate') != '' && session()->get('todate')) {
                                        $amcgett = DB::table('complaints')
                                            ->join('amcs', 'complaints._customer_id', '=', 'amcs._user_id')
                                            ->select('complaints._customer_id')
                                            ->groupby('complaints._customer_id')
                                            ->whereBetween('complaints.created_at', [
                                                session()->get('fromdate') . ' 00:00:00',
                                                session()->get('todate') . ' 23:59:59',
                                            ])
                                            ->get();
                                    } else {
                                        $amcgett = DB::table('complaints')
                                            ->join('amcs', 'complaints._customer_id', '=', 'amcs._user_id')
                                            ->select('complaints._customer_id')
                                            ->groupby('complaints._customer_id')
                                            ->get();
                                    }

                                @endphp

                                @foreach ($amcgett as $rowamc)
                                    @php $amccount++; @endphp
                                @endforeach

                                @php

                                    $balance = $complaintscount - $amccount;
                                @endphp
                            </div>
                        </div>
                        <!--<div class="mt-6 text-3xl font-medium leading-8">3.721</div>-->
                        <!--<div class="mt-1 text-base text-slate-500">Customer Complain</div>-->
                        <div class="mt-6 text-3xl font-medium leading-8"> {{ $balance }}</div>
                        <div class="mt-1 text-base text-slate-500">Customer Complaint </div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">
                <div @class([
                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-warning" icon="Monitor" />
                            {{-- <div class="ml-auto">
                                <x-base.tippy
                                    class="flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                    as="div" content="12% Higher than last month">
                                    12%
                                    <x-base.lucide class="ml-0.5 h-4 w-4" icon="ChevronUp" />
                                </x-base.tippy>
                            </div> --}}
                        </div>
                        @php
                            $amccount = 0;
                            if (session()->get('fromdate') != '' && session()->get('todate')) {
                                $amcgett = DB::table('complaints')
                                    ->join('amcs', 'complaints._customer_id', '=', 'amcs._user_id')
                                    ->select('complaints._customer_id')
                                    ->groupby('complaints._customer_id')
                                    ->whereBetween('complaints.created_at', [
                                        session()->get('fromdate') . ' 00:00:00',
                                        session()->get('todate') . ' 23:59:59',
                                    ])
                                    ->get();
                            } else {
                                $amcgett = DB::table('complaints')
                                    ->join('amcs', 'complaints._customer_id', '=', 'amcs._user_id')
                                    ->select('complaints._customer_id')
                                    ->groupby('complaints._customer_id')
                                    ->get();
                            }

                        @endphp
                        @foreach ($amcgett as $rowamc)
                            @php $amccount++; @endphp
                        @endforeach
                        <div class="mt-6 text-3xl font-medium leading-8">{{ $amccount }}</div>
                        <div class="mt-1 text-base text-slate-500">
                            AMC Complain
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-6 xl:col-span-3">

                <div @class([
                    'before:content-[\'\'] before:w-[90%] before:shadow-[0px_3px_20px_#0000000b] before:bg-slate-50 before:h-full before:mt-3 before:absolute before:rounded-md before:mx-auto before:inset-x-0 before:dark:bg-darkmode-400/70',
                ])>
                    <div class="box p-5">
                        <div class="flex">
                            <x-base.lucide class="h-[28px] w-[28px] text-success" icon="User" />
                            {{-- <div class="ml-auto">
                                <x-base.tippy
                                    class="flex cursor-pointer items-center rounded-full bg-success py-[3px] pl-2 pr-1 text-xs font-medium text-white"
                                    as="div" content="22% Higher than last month">
                                    22%
                                    <x-base.lucide class="ml-0.5 h-4 w-4" icon="ChevronUp" />
                                </x-base.tippy>
                            </div> --}}
                        </div>
                        @php
                            if (session()->get('fromdate') != '' && session()->get('todate')) {
                                $complaintscount = DB::table('jobs')
                                    ->where('status', 'Complete')
                                    ->whereBetween('created_at', [
                                        session()->get('fromdate') . ' 00:00:00',
                                        session()->get('todate') . ' 23:59:59',
                                    ])
                                    ->count();
                            } else {
                                $complaintscount = DB::table('jobs')->where('status', 'Complete')->count();
                            }
                            // $complaintscount = DB::table('complaints')->count();
                        @endphp

                        <div class="mt-6 text-3xl font-medium leading-8">{{ $complaintscount }}</div>

                        <div class="mt-1 text-base text-slate-500"> Complete Complain</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- END: General Report -->

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

    <script>
        function reset()

        {

            window.location.href = "{{ url('reset') }}";

        }
    </script>

    <!-- <h2 class="mt-10 text-lg font-medium intro-y">Complain Report</h2> -->
    <div class="" style="display: flex;justify-content: flex-end">
        <div class="mt-6 ">
            <div></div>
            <div class="relative w-56 text-slate-500">
                <form method="get" action="{{ route('complainreport') }}">
                    <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..."
                        value="{{ Request::get('search') ? Request::get('search') : '' }}" />
                    <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                </form>
            </div>
        </div>
        <div class="">
            <form action='{{ route('create.report.form.resetfilter') }}' method="post" enctype="multipart/form-data">
                @csrf
                <button
                    class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                    id="btnExport" onclick="fnExcelReport3();"
                    style="float: right;font-size: 15px;margin-top: 23px;margin-left: 15px">Export</button>
            </form>
        </div>
    </div>
    {{-- <div style="display:flex; width:100%;">
        <div style="width:100%;">
            <form action='{{ route('create.report.form.resetfilter') }}' method="post" enctype="multipart/form-data">
                @csrf                    
                <button
                    class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                    id="btnExport" onclick="fnExcelReport3();"
                    style="float: right;font-size: 15px;margin-top: 33px;">Export</button>
            </form>
        </div>
    </div> --}}


    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">



            <a href="{{ route('job.create.form') }}"
                class=" hidden  mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Create
                Job</a>





        </div>

        <!-- BEGIN: Data List -->



        <!-- END: Data List -->

        <!-- BEGIN: Pagination -->

        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">

            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" id="default-datatable">

                <x-base.table.thead class='text-center'>

                    <x-base.table.tr>



                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Id

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Customer Name

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Complaint Number

                        </x-base.table.th>

                        <!-- <x-base.table.th class="border-b-0 whitespace-nowrap">

                                                                        Product

                                                                    </x-base.table.th> -->

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Job Category

                        </x-base.table.th>


                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Technician

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Helper

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Status

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Date

                        </x-base.table.th>

                        <!--<x-base.table.th class="text-center border-b-0 whitespace-nowrap">-->

                        <!--    Action-->

                        <!--</x-base.table.th>-->



                    </x-base.table.tr>

                </x-base.table.thead>

                <x-base.table.tbody>


                    @php $i = 0; @endphp
                    @foreach ($jobs as $row)
                        @php
                            $i++;

                            $customercount = DB::table('customer_details')

                                ->where('id', $row->address)

                                ->count();

                            // print_r($jobs);

                            // exit;

                        @endphp



                        <x-base.table.tr class="intro-x text-center">

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                {{ $i }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                               <b> <a href="{{ route('complainreport.list', $row->customer_id) }}">
                                    {{ $row->name }}
                                </a></b>
                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                <a href='{{ route('job.invoice', $row->id) }}'
                                    target='_BLANK'>{{ $row->job_ref_no }}</a>

                            </x-base.table.td>

                            <!-- <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                                                           {{ $row->product }}

                                                                        </x-base.table.td> -->

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                {{ $row->job_category }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                @if ($row->technician_id != '0')
                                    @php

                                        $technicians = DB::table('technicians')
                                            ->where('id', $row->technician_id)
                                            ->first();

                                        if ($technicians !== null) {
                                            echo "$technicians->name";
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

                                <div class="flex items-center justify-center text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" icon-name="check-square"
                                        data-lucide="check-square"
                                        class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>
                                    {{ $row->status }}
                                </div>

                                @if ($row->status == 'Complete')
                                    <a href="{{ route('RepeatComplaint', $row->complaint_id) }}">
                                        <div class="flex items-center justify-center text-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" icon-name="repeat-square"
                                                data-lucide="repeat-square"
                                                class="lucide lucide-repeat-square stroke-1.5 mr-2 h-4 w-4">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>
                                            <span style="color: red;">Repeat</span>
                                        </div>
                                    </a>
                                @endif



                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                            </x-base.table.td>


                            <!--<x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >-->

                            <!--    <a-->

                            <!--                        class="flex items-center text-success"-->

                            <!--                        href="{{ route('job.assign_technician', ['id' => $row->id]) }}"-->

                            <!--                    >-->

                            <!--                    <x-base.lucide-->

                            <!--                            class="mr-1 h-4 w-4"-->

                            <!--                            icon="CheckSquare"-->

                            <!--                        />-->

                            <!--                        Assign Job-->

                            <!--                    </a>-->

                            <!-- </x-base.table.td>-->



                        </x-base.table.tr>
                    @endforeach

                </x-base.table.tbody>

            </x-base.table>

        </div>

        <!-- END: Pagination -->

    </div>

    <!-- BEGIN: Delete Confirmation Modal -->

    <x-base.dialog id="delete-confirmation-modal">

        <x-base.dialog.panel>

            <div class="p-5 text-center">

                <x-base.lucide class="w-16 h-16 mx-auto mt-3 text-danger" icon="XCircle" />

                <div class="mt-5 text-3xl">Are you sure?</div>

                <div class="mt-2 text-slate-500">

                    Do you really want to delete these records? <br />

                    This process cannot be undone.

                </div>

            </div>

            <div class="px-5 pb-8 text-center">

                <x-base.button class="w-24 mr-1" data-tw-dismiss="modal" type="button" variant="outline-secondary">

                    Cancel

                </x-base.button>

                <x-base.button class="w-24" type="button" variant="danger">

                    Delete

                </x-base.button>

            </div>

        </x-base.dialog.panel>

    </x-base.dialog>







    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">

        <div class="relative w-full max-w-2xl max-h-full">

            <!-- Modal content -->

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <!-- Modal header -->

                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">

                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">

                        Terms of Service

                    </h3>

                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="defaultModal">

                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">

                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />

                        </svg>

                        <span class="sr-only">Close modal</span>

                    </button>

                </div>

                <!-- Modal body -->

                <div class="p-6 space-y-6">

                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">

                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.

                    </p>

                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">

                        The European Union�s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is
                        meant to ensure a common set of data rights in the European Union. It requires organizations to
                        notify users as soon as possible of high-risk data breaches that could personally affect them.

                    </p>

                </div>

                <!-- Modal footer -->

                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                    <button data-modal-hide="defaultModal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                        accept</button>

                    <button data-modal-hide="defaultModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>

                </div>

            </div>

        </div>

    </div>

    <!-- END: Delete Confirmation Modal -->

    <script>
        function fnExcelReport3() {
            var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange;
            var j = 0;
            tab = document.getElementById('default-datatable'); // id of table

            for (j = 0; j < tab.rows.length; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                //tab_text=tab_text+"</tr>";
            }

            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
            tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");

            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
            {
                txtArea3.document.open("txt/html", "replace");
                txtArea3.document.write(tab_text);
                txtArea3.document.close();
                txtArea3.focus();
                sa = txtArea3.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
            } else //other browser not tested on IE 11
                sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

            return (sa);
        }
    </script>
@endsection
