@extends('../layouts/side-menu')



@section('subhead')
    <title>Complain Report Detail</title>
@endsection



@section('subcontent')
    <!-- BEGIN: General Report -->
    <h2 class="intro-y mt-10 text-lg font-medium">Complaint Report Detail</h2>

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
                                <a href="{{ route('complainreport.detail',$row->id) }}">
                                    {{ $row->name }}
                                </a>

                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                <a href='{{ route('job.invoice', $row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>

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

                            </x-base.table.td>

                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}
                            </x-base.table.td>

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

@endsection
