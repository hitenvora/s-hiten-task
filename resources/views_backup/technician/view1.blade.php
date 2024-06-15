@extends('../layouts/' . 'side-menu')



@section('subhead')
    <title>Technician Attendance - Midone - Tailwind HTML Admin Template</title>
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

    <div class="" style="display: flex;justify-content: space-between;">
        <div class="intro-y mt-8 flex items-center">

            <h2 class="mr-auto text-lg font-medium"> {{ $technician->name }} Attendance Layout</h2>

        </div>
        <div class="" style="display: flex;justify-content: space-between">
            <div></div>
            <div class="" style="display: flex; justify-content: flex-end;">
                <div>
                    <form action='{{ route('technician.profile1', $id) }}' method="get" enctype="multipart/form-data">
                        @csrf
                        <table>
                            <tbody>
                                @php
                                    $startDate = now()->startOfMonth();
                                    $endDate = now()->endOfMonth();
                                @endphp
                                <tr>
                                    <td>
                                        <div class="input-form mt-3">
                                            <label for="start-date">From Date</label>
                                            <input name="from_date" type="date" id="from_date" required="required"
                                                value="{{ request()->get('from_date') != null ? request()->get('from_date') : $startDate->format('Y-m-d') }}"
                                                class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-form mt-3">
                                            <label for="end-date">To Date</label>
                                            <input name="to_date" type="date" id="to_date" required="required"
                                                value="{{ request()->get('to_date') != null ? request()->get('to_date') : $endDate->format('Y-m-d') }}"
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
                <div class="">
                    <button type="button"
                        class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5"
                        style="margin-top: 33px; margin-left: 10px;"
                        onclick="location.href='{{ route('technician.profile1', $id) }}'">Clear</button>
                </div>
                <button
                    class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"
                    id="btnExport" onclick="fnExcelReport3();"
                    style="float: right;font-size: 15px;margin-top: 31px;margin-left: 15px;">Export</button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <h2 style="font-size: 17px;"><b>Total Salary : {{ $totalSalaries }}</b></h2>
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" id="default-datatable">

                <x-base.table.thead class='text-center'>

                    <x-base.table.tr>
                        
                        <x-base.table.th class="border-b-0 whitespace-nowrap text-center">
                            Sr No.
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Address
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Date
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Hour
                        </x-base.table.th>

                        <!-- <x-base.table.th class="border-b-0 whitespace-nowrap">
                                Product
                            </x-base.table.th> -->

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Salary
                        </x-base.table.th>

                    </x-base.table.tr>

                </x-base.table.thead>

                <x-base.table.tbody>


                    @php
                        $i = 0;
                        $perdayearnsalary = 0;
                    @endphp
                    @foreach ($attendance as $row)
                        @php
                            $i++;
                            $attendancecountt = DB::table('attendances')
                                ->whereDate('check_time', $row->date)
                                ->where('technician_id', $id)
                                ->orderby('id', 'DESC')
                                ->count();

                            if ($attendancecountt > 0) {
                                $attendancedetail = DB::table('attendances')
                                    ->whereDate('check_time', $row->date)
                                    ->where('technician_id', $id)
                                    ->orderby('id', 'DESC')
                                    ->first();

                                $address = $attendancedetail->address;
                                $diff_in_hours = 0;

                                $attendancedetail111count = DB::table('attendances')
                                    ->whereDate('check_time', $row->date)
                                    ->where('technician_id', $id)
                                    ->orderby('id', 'ASC')
                                    ->count();

                                if ($attendancedetail111count > 0) {
                                    $attendancedetail111 = DB::table('attendances')
                                        ->whereDate('check_time', $row->date)
                                        ->where('technician_id', $id)
                                        ->orderby('id', 'ASC')
                                        ->get();

                                    $checkindate = '';
                                    $checkoutdate = '';
                                    foreach ($attendancedetail111 as $row111) {
                                        if ($row111->check_status == 'In') {
                                            $checkindate = $row111->check_time;
                                        } elseif ($row111->check_status == 'Out') {
                                            $checkoutdate = $row111->check_time;
                                        }

                                        $checkin = Carbon\Carbon::parse($checkindate)->format('Y-m-d');
                                        $checkout = Carbon\Carbon::parse($checkoutdate)->format('Y-m-d');
                                        if ($checkin == $checkout) {
                                            $start = new Carbon\Carbon($checkindate);
                                            $end = new Carbon\Carbon($checkoutdate);

                                            if ($end == date('Y-m-d H:i:s')) {
                                            } else {
                                                $diff_in_hours111 = $start->diff($end)->format('%H');

                                                $diff_in_hours = $diff_in_hours111 + $diff_in_hours;
                                            }
                                        }
                                    }
                                }
                            } else {
                                $address = '';
                                $diff_in_hours = 0;
                            }

                            $monthsalary = $monthsalary = $technician->monthly_salary / 30;
                            $perhoursalary = $perhoursalary = $monthsalary / 11;
                            $perdayearnsalary = $perhoursalary * $diff_in_hours;
                        @endphp
                        <x-base.table.tr class="intro-x text-center">
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $i }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $address }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ date('d-m-Y', strtotime($row->date)) }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $diff_in_hours }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ number_format($perdayearnsalary, 2) }}
                            </x-base.table.td>

                        </x-base.table.tr>
                    @endforeach

                </x-base.table.tbody>

            </x-base.table>

        </div>
    </div>

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
