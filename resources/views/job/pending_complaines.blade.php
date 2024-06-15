@extends('../layouts/side-menu')
@section('subhead')
<title>Pending Compliance</title>
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
<script src="{{asset('js/')}}/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">

        <h2 class="text-lg font-medium intro-y">List Pending Compliance</h2>
        <div class="mx-auto hidden text-slate-500 md:block">
        </div>
        <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0 flex flex-wrap items-center sm:flex-nowrap">
            <div class="relative w-56 text-slate-500">
                <!-- <x-base.form-input
            class="!box w-56 pr-10"
            type="text"
            id="searchInput"
            placeholder="Search..."
        />
        <x-base.lucide
            class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"
            icon="Search"
        /> -->
                <form method="get" action="/search-job">
                    <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..." value="{{isset($search) ? $search : '' }}" />
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
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
        <a href="{{ route('job.create.form') }}" class=" hidden  mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Create Job</a>
    </div>

    <!-- BEGIN: Data List -->
    <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
        <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" style="margin-top: 0px;">
            <x-base.table.thead class='text-center'>
                <x-base.table.tr>
                    <x-base.table.th class="border-b-0 whitespace-nowrap text-center">
                        Number
                    </x-base.table.th>
                    <x-base.table.th class="border-b-0 whitespace-nowrap text-center">
                        Complaint Number
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Customer Name

                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Customer Address
                    </x-base.table.th>
                    <!-- <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Product

                        </x-base.table.th> -->

                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Remark
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Create At
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Assine Status
                    </x-base.table.th>
                    <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                        Status
                    </x-base.table.th>
                    <x-base.table.th class=" border-b-0 whitespace-nowrap">
                        Action
                    </x-base.table.th>
                </x-base.table.tr>
            </x-base.table.thead>

            <x-base.table.tbody>
                @php $i = 0; @endphp
                @foreach ($pending_complaines as $row)
                @php
                $getJobData = DB::table('jobs')
                ->where('complaint_id', $row->id)
                ->count();
                @endphp
                @php
                $i ++;
                @endphp
                <x-base.table.tr class="intro-x text-center">
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $i }}
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        <a href='{{ route('job.invoice',$row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        @if ($row->customer_id != '0')
                        @php
                        $customer = DB::table('users')->where('id', $row->customer_id)->first();
                        if ($customer !== null) {
                        echo " $customer->name ";
                        }
                        else{
                            echo "-";
                        }
                        @endphp
                        @endif
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        @if ($row->address != '0')
                        @php
                        $address = DB::table('customer_details')->where('id', $row->address)->first();
                        if ($address !== null) {
                        echo " $address->location_type ";
                        }
                        else{
                            echo"-";
                        }
                        @endphp
                        @endif
                    </x-base.table.td>
                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                        {{ $row->job_remark }}

                    </x-base.table.td>
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
                        {{ $row->status }}

                    </x-base.table.td>

                    <x-base.table.td class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                    <form id="deleteForm-{{ $row->id }}" action="{{ route('job.destroy', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE') <!-- Method Spoofing -->
                        <button type="button" onclick="deleteJob('{{ $row->id }}')" class="px-2 py-1 flex items-center text-danger">
                            <x-base.lucide class="mr-1 h-4 w-4" icon="Trash" />
                            Delete
                        </button>
                    </form>
                </x-base.table.td>
                </x-base.table.tr>
                @endforeach
            </x-base.table.tbody>
        </x-base.table>
    </div>
    <!-- END: Data List -->
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

<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Terms of Service
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union�s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="defaultModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteJob(jobId) {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this job!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-' + jobId).submit();
            }
        });
    }
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
<!-- END: Delete Confirmation Modal -->
<script>
    // Get the input element and table
    var searchInput = document.getElementById("searchInput");
    var tableRows = document.querySelectorAll(".intro-x.text-center");

    // Attach an input event listener to the search input
    searchInput.addEventListener("input", function() {
        var searchQuery = searchInput.value.toLowerCase();

        // Loop through table rows and hide/show based on the search query
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