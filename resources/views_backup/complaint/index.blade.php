@extends('../layouts/side-menu')

@section('subhead')
<title>List Complaint</title>
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
</style>

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


<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">

        <a href="{{ route('create.complaint') }}" class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style="width:200px;">Create Complaint</a>
        <div class="mx-auto hidden text-slate-500 md:block">

        </div>
        <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0 flex flex-wrap items-center sm:flex-nowrap">
            <div class="relative w-56 text-slate-500">
                <form method="get" action="/search">
                    <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..." value="{{ isset($search) ? $search : '' }}" />
                    <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                </form>
            </div>
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn" style="width: 34px;"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                <div id="myDropdown" class="dropdown-content">
                    <a><button class="btn btn-warning" id="btnExport" onclick="fnExcelReport3();" style="padding:0px;">Export</button></a>
                    <a><button class="btn btn-warning" id="btnExport" onClick="printdiv('invoice');" style="padding:0px;">PDF</button></a>
                </div>
            </div>
        </div>

    </div>

    <!-- {{ Request::get('search') }} -->
    <!-- BEGIN: Data List -->
    <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
        <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" style="margin-top: 0px;">
            <x-base.table.thead class=''>
                <x-base.table.tr>
                    <x-base.table.th class="border-b-0 whitespace-nowrap">
                        Complaint No
                    </x-base.table.th>
                    <x-base.table.th class="border-b-0 whitespace-nowrap">
                        Customer Name
                    </x-base.table.th>
                    <x-base.table.th class=" border-b-0 whitespace-nowrap">
                        Customer Address
                    </x-base.table.th>
                    <!--<x-base.table.th class="border-b-0 whitespace-nowrap">-->
                    <!--    Mobile Number-->
                    <!--</x-base.table.th>-->
                    <x-base.table.th class="border-b-0 whitespace-nowrap">
                        Remark
                    </x-base.table.th>
                    {{-- <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Status
                        </x-base.table.th> --}}
                    <x-base.table.th class="border-b-0 whitespace-nowrap">
                        Created At
                    </x-base.table.th>
                    <x-base.table.th class="border-b-0 whitespace-nowrap">
                        Assine Status
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Acction
                    </x-base.table.th>
                </x-base.table.tr>
            </x-base.table.thead>
            <x-base.table.tbody>
                @php
                if (Request::get('search') != '') {
                $value = Request::get('search');
                $complaints = DB::table('complaints')
                ->join('users', 'complaints._customer_id', '=', 'users.id')
                ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
                ->select('complaints.*', 'users.name', 'customer_details.location_type')
                ->Where('users.name', 'like', "%{$value}%")
                ->where('complaints.status','=','Open')
                ->orWhere('complaints.ref_no', 'like', "%{$value}%")
                ->orderBy('id', 'DESC')
                ->get();
                } else {
                $complaints = DB::table('complaints')
                ->join('users', 'complaints._customer_id', '=', 'users.id')
                ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
                ->select('complaints.*', 'users.name', 'customer_details.location_type')
                ->where('complaints.status','=','Open')
                ->orderBy('id', 'DESC')
                ->get();
                }

                // print_r($complaints);
                // exit;
                $i = 0;
                @endphp
                @foreach ($complaints as $row)
                @php
                $i++;
                $getJobData = DB::table('jobs')
                ->where('complaint_id', $row->id)
                ->count();
                @endphp
                @if ($getJobData == 0)
                <x-base.table.tr class="intro-x">
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $row->ref_no }}
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $row->name }}
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $row->location_type }}
                    </x-base.table.td>
                    <!--<x-base.table.td id="mobile-cell" class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">-->
                    <!--    {{ isset($row->mobile) ? $row->mobile : 'N/A' }}-->
                    <!--</x-base.table.td>-->
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $row->remark }}
                    </x-base.table.td>
                    {{--
                                <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                    @if ($row->status == 'Open')
                                        <div class="flex  justify-center text-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                            {{ $row->status }}
    </div>
    @endif
    @if ($row->status == 'Close')
    <div class="flex justify-center text-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
        {{ $row->status }}
    </div>
    @endif
    @if ($row->status == 'Re-Open')
    <div class="flex  justify-center text-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
        {{ $row->status }}
    </div>
    @endif
    @if ($row->status == 'Hold')
    <div class="flex  justify-center text-danger">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
        {{ $row->status }}
    </div>
    @endif
    @if ($row->status == 'Processing')
    <div class="flex justify-center text-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
        {{ $row->status }}
    </div>
    @endif

    </x-base.table.td> --}}
    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
        {{ date('d-m-Y', strtotime($row->created_at)) }}
    </x-base.table.td>
    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
        <div class="flex  justify-center text-dark">
            @if ($getJobData == 0)
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <a class="flex items-center text-success ml-20" href="{{ route('job.create.form', ['Id' => $row->id]) }}">
                Create-Job
            </a>
            @else
            <!--<div class="flex  justify-center text-dark">-->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <a class="flex items-center text-success ml-20" href="#">
                Job-Created
            </a>
        </div>
        @endif
    </x-base.table.td>
    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
        <div class="flex  justify-center text-success">
            <a href="{{ route('edit.complaint', $row->id) }}">
                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">
                    <i data-lucide="edit" width="15" height="15" class="stroke-1.5 h-5 w-8"></i>Edit</button>
            </a>
            <a data-tw-merge data-tw-toggle="modal" data-tw-target="#delete-modal-preview{{ $i }}">
                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">
                    <i data-lucide="trash" width="15" height="15" class="stroke-1.5 h-5 w-8"></i>Delete</button>
            </a>
        </div>

        <!-- BEGIN: Modal Content -->

        <div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="delete-modal-preview{{ $i }}" class="modal group bg-black/60 transition-[visibility,opacity] w-screen h-screen fixed left-0 top-0 [&amp;:not(.show)]:duration-[0s,0.2s] [&amp;:not(.show)]:delay-[0.2s,0s] [&amp;:not(.show)]:invisible [&amp;:not(.show)]:opacity-0 [&amp;.show]:visible [&amp;.show]:opacity-100 [&amp;.show]:duration-[0s,0.4s]">
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
    </x-base.table.td>

    </x-base.table.tr>
    @endif
    @endforeach
    </x-base.table.tbody>
    </x-base.table>
</div>
<!-- END: Data List -->
<!-- BEGIN: Pagination -->


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


@push('script')
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
@endpush
<!-- END: Delete Confirmation Modal -->
@endsection
<div style="display:none;">
    <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible" id="invoice">
        <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" id="default-datatable">
            <x-base.table.thead class='' style='background-color: #164E63; color: #ffffff; text-align: left; font-weight: bold;'>
                <x-base.table.tr>
                    <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">
                        Complaint No
                    </x-base.table.th>
                    <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">
                        Customer Name
                    </x-base.table.th>
                    <x-base.table.th class=" border-b-0 whitespace-nowrap" style="padding:10px;">
                        Customer Address
                    </x-base.table.th>
                    <!--<x-base.table.th class="border-b-0 whitespace-nowrap">-->
                    <!--    Mobile Number-->
                    <!--</x-base.table.th>-->
                    <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">
                        Remark
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap" style="padding:10px;">
                        Status
                    </x-base.table.th>
                    <x-base.table.th class="border-b-0 whitespace-nowrap" style="padding:10px;">
                        Date
                    </x-base.table.th>
                </x-base.table.tr>
            </x-base.table.thead>
            <x-base.table.tbody>
                @php
                if (Request::get('search') != '') {
                $value = Request::get('search');
                $complaints = DB::table('complaints')
                ->join('users', 'complaints._customer_id', '=', 'users.id')
                ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
                ->select('complaints.*', 'users.name', 'customer_details.location_type')
                ->Where('users.name', 'like', "%{$value}%")
                ->orWhere('complaints.ref_no', 'like', "%{$value}%")
                ->get();
                } else {
                $complaints = DB::table('complaints')
                ->join('users', 'complaints._customer_id', '=', 'users.id')
                ->join('customer_details', 'complaints._customer_address_id', '=', 'customer_details.id')
                ->select('complaints.*', 'users.name', 'customer_details.location_type')
                ->get();
                }

                // print_r($complaints);
                // exit;

                @endphp
                @foreach ($complaints as $row)
                @php
                $getJobData = DB::table('jobs')
                ->where('complaint_id', $row->id)
                ->count();
                //$getJobData=0;
                @endphp
                <x-base.table.tr class="intro-x">
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px; border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">
                        {{ $row->ref_no }}
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px;border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">
                        {{ $row->name }}
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px;border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">
                        {{ $row->location_type }}
                    </x-base.table.td>
                    <!--<x-base.table.td id="mobile-cell" class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">-->
                    <!--    {{ isset($row->mobile) ? $row->mobile : 'N/A' }}-->
                    <!--</x-base.table.td>-->
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px;border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">
                        {{ $row->remark }}

                    </x-base.table.td>

                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px;border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">

                        @if ($row->status == 'Open')
                        <div class="flex  justify-center text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            {{ $row->status }}
                        </div>
                        @endif
                        @if ($row->status == 'Close')
                        <div class="flex justify-center text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            {{ $row->status }}
                        </div>
                        @endif
                        @if ($row->status == 'Re-Open')
                        <div class="flex  justify-center text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            {{ $row->status }}
                        </div>
                        @endif
                        @if ($row->status == 'Hold')
                        <div class="flex  justify-center text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            {{ $row->status }}
                        </div>
                        @endif
                        @if ($row->status == 'Processing')
                        <div class="flex justify-center text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            {{ $row->status }}
                        </div>
                        @endif

                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" style="padding:10px;border-left:1px solid #ddd; border-right:1px solid #ddd;border-bottom:1px solid #ddd;">
                        {{ date('d-m-Y', strtotime($row->created_at)) }}
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