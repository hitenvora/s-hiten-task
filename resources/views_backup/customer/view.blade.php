@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')

    <title>View Customer</title>

@section('subcontent')
    <style>
        .dropbtn {
            background-color: #164e63;
            margin-left: 7px;
            border-radius: 3px;
            color: white;
            padding: 8px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #164e63;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0px;
            top: 40px
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,500,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="{{ asset('js/') }}/html2pdf.bundle.min.js"></script>


    <h2 class="intro-y mt-10 text-lg font-medium">Manage Customer</h2>
    <div class="mt-5 grid grid-cols-12 gap-6">

        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">

            <a href="{{ route('create.customer.form') }}"
                class="mr-2 shadow-md border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                style="width:200px;">Add New Customer</a>
            <div class="mx-auto hidden text-slate-500 md:block">

            </div>
            <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0 flex flex-wrap items-center sm:flex-nowrap">
                <div class="relative w-56 text-slate-500">
                    <form method="get" action="/search-customer">
                        <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..."
                            value="{{ isset($search) ? $search : '' }}" />
                        <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                    </form>
                </div>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn" style="width: 34px;"><i class="fa fa-ellipsis-v"
                            aria-hidden="true"></i></button>
                    <div id="myDropdown" class="dropdown-content">
                        <a><button class="btn btn-warning" id="btnExport" onclick="fnExcelReport3();"
                                style="padding:0px;">Export</button></a>
                        <a><button class="btn btn-warning" id="btnExport" onClick="printdiv('invoice');"
                                style="padding:0px;">PDF</button></a>
                    </div>
                </div>
            </div>

        </div>


        @php

            use App\Models\User;

            $getUser = User::where('type', 3)->get();

            // print_r($Get_User);

            // exit;

        @endphp

        <!-- BEGIN: Users Layout -->

        <!-- BEGIN: Data List -->

        <!-- @foreach ($getUser as $data)
    <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2">

                    <div class="intro-y col-span-12 md:col-span-6 height="50px">

                        <div class="box">

                            <div class="flex flex-col items-center p-5 lg:flex-row">

                                <!-- <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">

                                    @if ($data->image == '')
    <img

                                            class="rounded-full"

                                            src="{{ asset('customer_image/demo.png') }}"

                                            alt="Midone Tailwind HTML Admin Template"

                                        />
@else
    <img

                                            class="rounded-full"

                                            src="{{ asset('customer_image/' . $data->image) }}"

                                            alt="Midone Tailwind HTML Admin Template"

                                        />
    @endif



                                </div> -->

        <!-- <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        {{ $data->name }}

                                    </a>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->user_name }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->email }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->phone_no }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->gender }}

                                    </div>

                                </div>

                                <div class="mt-4 flex lg:mt-0">



                                    <a href="{{ route('customer.profile', $data->id) }}">

                                    <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-opacity-90 hover:border-opacity-90 dark:hover:bg-opacity-70 dark:border-opacity-70 mb-2 mr-1">

                                        <i data-lucide="image" width="24" height="24" class="stroke-1.5 h-5 w-8"></i>Profile</button>

                                </a>

                                    <a href="{{ route('del.customer', ['id' => $data->id]) }}">

                                    <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">

                                        <i data-lucide="trash" width="24" height="24" class="stroke-1.5 h-5 w-8"></i>Delete</button>

                                </a>

                                </div>

                            </div>

                        </div>

                    </div>
    @endforeach -->

        <!-- @foreach ($getUser as $data)
    <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2">

                    <div class="intro-y col-span-12 md:col-span-6 height="50px">

                        <div class="box">

                            <div class="flex flex-col items-center p-5 lg:flex-row">

                                <!-- <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">

                                    @if ($data->image == '')
    <img

                                            class="rounded-full"

                                            src="{{ asset('customer_image/demo.png') }}"

                                            alt="Midone Tailwind HTML Admin Template"

                                        />
@else
    <img

                                            class="rounded-full"

                                            src="{{ asset('customer_image/' . $data->image) }}"

                                            alt="Midone Tailwind HTML Admin Template"

                                        />
    @endif



                                </div> -->

        <!-- <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        {{ $data->name }}

                                    </a>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->user_name }}

                                    </div>

                                     <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->email }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->phone_no }}

                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">

                                        {{ $data->gender }}

                                    </div>

                                </div>

                                <div class="mt-4 flex lg:mt-0">



                                    <a

                                        class="px-2 py-1 bg-success text-white mx-2"

                                        variant="outline-secondary"

                                        href='{{ route('customer.profile', $data->id) }}'

                                    >

                                        Profile

                                </a>

                                    <a

                                        class="px-2 py-1 bg-danger text-white mx-2"

                                        variant="outline-secondary"

                                        href='{{ route('del.customer', ['id' => $data->id]) }}'

                                    >

                                        Delete

                                </a>

                                </div>

                            </div>

                        </div>

                    </div>
    @endforeach -->

        <style>
            .content-table {

                border-collapse: collapse;

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

        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2">

            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" style="margin-top:0px;">

                <x-base.table.thead>

                    <x-base.table.tr>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Id

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Name

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Location Type

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Total A/C

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Total Ton

                        </x-base.table.th>



                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Phone Number

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Actions

                        </x-base.table.th>

                    </x-base.table.tr>

                </x-base.table.thead>

                <x-base.table.tbody>

                    @php
                        if (Request::get('search') != '') {
                            $value = Request::get('search');
                            $getUser = DB::table('users')
                                ->where('type', 3)
                                ->Where('name', 'like', "%{$value}%")
                                ->where('deleted_at', null)
                                ->orderBy('id', 'DESC')
                                ->get();
                        } else {
                            $getUser = DB::table('users')
                                ->where('deleted_at', null)
                                ->where('type', 3)
                                ->orderBy('id', 'DESC')
                                ->get();
                        }
                        $i = 0;
                    @endphp

                    @foreach ($getUser as $key => $data)
                        @php $i++;  @endphp
                        <x-base.table.tr class="intro-x">

                            <x-base.table.td
                                class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                {{ $key + 1 }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                {{ $data->name }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                @php

                                    $customerDetails = DB::table('customer_details')

                                        ->where('_user_id', $data->id)

                                        ->get();

                                    $location = '';

                                @endphp

                                @foreach ($customerDetails as $value11)
                                    @php

                                        $locationtype = $value11->location_type;

                                        $location = $locationtype . ', ' . $location;

                                    @endphp
                                @endforeach

                                {{ $location }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                @php
                                    $no_ac = DB::table('ac_detail')
                                        ->where('_user_id', $data->id)
                                        ->sum('no_ac');
                                @endphp

                                {{ $no_ac }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                @php
                                    $no_ton = DB::table('ac_detail')
                                        ->where('_user_id', $data->id)
                                        ->sum('no_of_ton');
                                @endphp

                                {{ $no_ton }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="text-center border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                                {{ $data->phone_no }}

                            </x-base.table.td>

                            <x-base.table.td
                                class="text-center border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                                style="display: flex;text-align: center;justify-content: center;">

                                <!--<a class="px-2 py-1 bg-success text-white mx-2" href="{{ route('customer.profile', $data->id) }}">-->

                                <!--    Profile-->

                                <!--</a>-->



                                <!--Profile Button-->

                                <a href="{{ route('customer.profile', $data->id) }}">

                                    <button data-tw-merge
                                        class="border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-opacity-90 hover:border-opacity-90 dark:hover:bg-opacity-70 dark:border-opacity-70 mb-2 mr-1">

                                        <i data-lucide="image" width="24" height="24"
                                            class="stroke-1.5 h-5 w-8"></i>Profile</button>

                                </a>



                                <!--Delete Button-->

                                <!--<a href="{{ route('del.customer', ['id' => $data->id]) }}">-->

                                <!--    <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">-->

                                <!--        <i data-lucide="trash" width="15" height="15" class="stroke-1.5 h-5 w-8"></i>Delete</button>-->

                                <!--</a>-->

                                <form action="{{ route('del.customer', ['id' => $data->id]) }}" method="GET"
                                    onsubmit="return confirm('Delete Customer')">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id }}" />
                                    <button data-tw-merge type="submit"
                                        class="border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">

                                        <i data-lucide="trash" width="15" height="15"
                                            class="stroke-1.5 h-5 w-8"></i>Delete</button>
                                </form>



                                <!--Edit Button-->

                                <a href="{{ route('edit.customer', $data->id) }}">

                                    <button data-tw-merge
                                        class="transition duration-0 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">

                                        <i data-lucide="edit" width="15" height="15"
                                            class="stroke-1.5 h-5 w-8"></i>Edit</button>

                                </a>

                            </x-base.table.td>

                        </x-base.table.tr>
                    @endforeach

                </x-base.table.tbody>

            </x-base.table>

        </div>

        <!-- BEGIN: Users Layout -->

        <!-- BEGIN: Pagination -->

        {{-- <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">

            <x-base.pagination class="w-full sm:mr-auto sm:w-auto">

                <x-base.pagination.link>

                    <x-base.lucide

                        class="h-4 w-4"

                        icon="ChevronsLeft"

                    />

                </x-base.pagination.link>

                <x-base.pagination.link>

                    <x-base.lucide

                        class="h-4 w-4"

                        icon="ChevronLeft"

                    />

                </x-base.pagination.link>

                <x-base.pagination.link>...</x-base.pagination.link>

                <x-base.pagination.link>1</x-base.pagination.link>

                <x-base.pagination.link active>2</x-base.pagination.link>

                <x-base.pagination.link>3</x-base.pagination.link>

                <x-base.pagination.link>...</x-base.pagination.link>

                <x-base.pagination.link>

                    <x-base.lucide

                        class="h-4 w-4"

                        icon="ChevronRight"

                    />

                </x-base.pagination.link>

                <x-base.pagination.link>

                    <x-base.lucide

                        class="h-4 w-4"

                        icon="ChevronsRight"

                    />

                </x-base.pagination.link>

            </x-base.pagination>

            <x-base.form-select class="!box mt-3 w-20 sm:mt-0">

                <option>10</option>

                <option>25</option>

                <option>35</option>

                <option>50</option>

            </x-base.form-select>

        </div> --}}

        <!-- END: Pagination -->

    </div>
    <script>
        var searchInput = document.getElementById("searchInput");
        var tableRows = document.querySelectorAll(".intro-x.text-center");

        searchInput.addEventListener("input", function() {
            var searchQuery = searchInput.value.toLowerCase();

            tableRows.forEach(function(row) {
                var rowData = row.textContent.toLowerCase();
                if (rowData.includes(searchQuery)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
    <script>
        $('body').on('change', '#_user_id', function() {
            var User_Id = $(this).val();
            jQuery.ajax({
                url: '{{ route('get.customer.mobile') }}',
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    User_Id: User_Id
                },
                success: function(result) {
                    // Set the value of the "Customer Mobile Number" input field
                    $("#mobile").val(result);

                    // Update the corresponding table cell with the mobile number
                    $("#mobile-cell").text(result);
                },
                error: function() {
                    // Handle errors, e.g., display "N/A" in both the input field and the table cell
                    $("#mobile").val('N/A');
                    $("#mobile-cell").text('N/A');
                }
            });
        });
    </script>
    <script>
        function generatePDF() {

            const element = document.getElementById("pdff");

            html2pdf()
                .from(element)
                .save();
        }
    </script>
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

@endsection



@once

@push('vendors')
    @vite('resources/js/vendor/pristine/index.js')

    @vite('resources/js/vendor/toastify/index.js')
@endpush

@endonce



@once

@push('scripts')
    @vite('resources/js/pages/validation/index.js')
@endpush

@endonce

<div style="display:none;">
<div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible mt-2" id="invoice">

    <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" id="default-datatable"
        style="margin-top:0px;">

        <x-base.table.thead
            style='background-color: #164E63; color: #ffffff; text-align: left; font-weight: bold;'>

            <x-base.table.tr>

                <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">

                    Id

                </x-base.table.th>

                <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">

                    Name

                </x-base.table.th>

                <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">

                    Location Type

                </x-base.table.th>

                <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">

                    Total A/C

                </x-base.table.th>



                <x-base.table.th class="text-center border-b-0 whitespace-nowrap" style="padding:10px;">

                    Phone Number

                </x-base.table.th>



            </x-base.table.tr>

        </x-base.table.thead>

        <x-base.table.tbody>

            @php
                if (Request::get('search') != '') {
                    $value = Request::get('search');
                    $getUser = DB::table('users')
                        ->where('type', 3)
                        ->Where('name', 'like', "%{$value}%")
                        ->get();
                } else {
                    $getUser = DB::table('users')->where('type', 3)->get();
                }

            @endphp

            @foreach ($getUser as $data)
                <x-base.table.tr class="intro-x">

                    <x-base.table.td
                        class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                        style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        {{ $data->id }}

                    </x-base.table.td>

                    <x-base.table.td
                        class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                        style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        {{ $data->name }}

                    </x-base.table.td>

                    <x-base.table.td
                        class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                        style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        @php

                            $customerDetails = DB::table('customer_details')

                                ->where('_user_id', $data->id)

                                ->get();

                            $location = '';

                        @endphp

                        @foreach ($customerDetails as $value11)
                            @php

                                $locationtype = $value11->location_type;

                                $location = $locationtype . ', ' . $location;

                            @endphp
                        @endforeach

                        {{ $location }}

                    </x-base.table.td>

                    <x-base.table.td
                        class="border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                        style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        @php

                            $no_ac = DB::table('customer_details')

                                ->where('_user_id', $data->id)

                                ->sum('no_ac');

                        @endphp

                        {{ $no_ac }}

                    </x-base.table.td>

                    <x-base.table.td
                        class="text-center border-b-0 bg-white py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                        style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        {{ $data->phone_no }}

                    </x-base.table.td>

                </x-base.table.tr>
            @endforeach

        </x-base.table.tbody>

    </x-base.table>

</div>
</div>


<script>
    function printdiv(elem) {
        var header_str = '<html><head><title>' + document.title + '</title></head><body>';
        var footer_str = '</body></html>';
        var new_str = document.getElementById(elem).innerHTML;
        var old_str = document.body.innerHTML;
        document.body.innerHTML = header_str + new_str + footer_str;
        window.print();
        document.body.innerHTML = old_str;
        return false;
    }
</script>
