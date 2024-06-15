@extends('../layouts/' . 'side-menu')



@section('subhead')
    <title>Technician Profile</title>
@endsection



@section('subcontent')
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

        .search-input {
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            margin-right: 10px;
        }

        /* Style for the search button */
        .search-button {
            background-color: #007bff;
            /* Change the color to your preference */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
        }

        /* Hover effect for the search button */
        .search-button:hover {
            background-color: #0056b3;
            /* Change the color to a darker shade for hover effect */
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
        .map {
            flex: 1;
            background: #f0f0f0;
        }

        #mymap {
            border: 1px solid red;
            width: 800px;
            height: 500px;
        }
    </style>

    <div class="intro-y mt-8 flex items-center">

        <h2 class="mr-auto text-lg font-medium">AMC Detail</h2>

    </div>

    <x-base.tab.group>

        <!-- BEGIN: Profile Info -->

        <div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-3 lg:text-left" style="font-size: 17px;">
                        Customer Detail
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">

                        <div class="flex items-center truncate sm:whitespace-normal">

                            <x-base.lucide class="mr-2 h-4 w-4" icon="Mail" />

                            {{ $amc->name }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            <x-base.lucide class="mr-2 h-4 w-4" icon="phone" /> Mobile

                            {{ $amc->phone_no }}

                        </div>

                    </div>

                </div>

                <div
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">

                    <div class="text-center font-medium lg:text-left" style="font-size: 17px;">

                        Amc Detail

                    </div>

                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">

                        <div class="flex items-center truncate sm:whitespace-normal">

                            <b>Start Date :</b>

                            {{ $amc->start_date }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            <b> End Date :</b>
                            {{ $amc->end_date }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            <b> Location Type :</b>

                            {{ $amc->location_type }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                            <b>Address :</b>
                            {{ $amc->address }}
                        </div>
                    </div>
                </div>
            </div>


    </x-base.tab.group>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <h3 class="mr-auto text-lg font-medium">Visit Report</h3>
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table">

                <x-base.table.thead class='text-center'>

                    <x-base.table.tr>

                        <x-base.table.th class="border-b-0 whitespace-nowrap text-center">

                            SL

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Visit Date

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap text-center">

                            Complaint Number

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Supervisor Name

                        </x-base.table.th>


                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Technician

                        </x-base.table.th>


                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Helper

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Job Category

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Status

                        </x-base.table.th>




                    </x-base.table.tr>

                </x-base.table.thead>

                <x-base.table.tbody>

                    @if (count($visits) > 0)
                        @foreach ($visits as $key => $row)
                            @php
                                $complaint = DB::table('complaints')
                                    ->where('id', $row->complaint_id)
                                    ->first();
                                $job = DB::table('jobs')
                                    ->where('complaint_id', $row->complaint_id)
                                    ->first();
                            @endphp
                            <x-base.table.tr class="intro-x text-center">

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    {{ $key + 1 }}

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    {{ $row->visit_date }}


                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    @if ($complaint)
                                        {{ $complaint->ref_no }}
                                    @else
                                        N/A
                                    @endif
                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    @if ($job)
                                        {{ $job->supervisor_name }}
                                    @else
                                        N/A
                                    @endif
                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                    @if ($job)
                                        @php
                                            $technician = DB::table('technicians')
                                                ->where('id', $job->technician_id)
                                                ->first();
                                        @endphp
                                        {{ $technician->name }}
                                    @else
                                        N/A
                                    @endif

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    @if ($job)
                                        @php
                                            $helper = DB::table('helper')
                                                ->where('id', $job->helper_id)
                                                ->first();
                                        @endphp
                                        {{ $helper->name }}
                                    @else
                                        N/A
                                    @endif

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                    @if ($job)
                                        {{ $job->job_category }}
                                    @else
                                        N/A
                                    @endif

                                </x-base.table.td>

                                <x-base.table.td
                                    class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">


                                    @if ($job)
                                        <div class="flex items-center justify-center text-warning">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" icon-name="check-square"
                                                data-lucide="check-square"
                                                class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>

                                            {{ $job->status }}

                                        </div>
                                    @else
                                        N/A
                                    @endif

                                </x-base.table.td>

                            </x-base.table.tr>
                        @endforeach
                    @else
                        <x-base.table.tr class="intro-x text-center">

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" colspan="8">

                                Record Not Found

                            </x-base.table.td>
                        </x-base.table.tr>
                    @endif

                </x-base.table.tbody>

            </x-base.table>

        </div>
    </div>
@endsection

@push('script')
@endpush
