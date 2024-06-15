@extends('../layouts/side-menu')

@section('subhead')
    <title>Assign Technicians</title>
@endsection

@section('subcontent')
    <h2 class="mt-10 text-lg font-medium intro-y">List Assign Technicians Job</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">

            <a href="{{ route('job.create.form') }}"
                class=" hidden  mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Create
                Job</a>


        </div>
        <!-- BEGIN: Data List -->
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px]">
                <x-base.table.thead class='text-center'>
                    <x-base.table.tr>

                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            Id
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            Customer Name
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Ref No
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            Product
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            job_category
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            City - Postal Code
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Supervisor Name
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Status
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Technicians
                        </x-base.table.th>


                    </x-base.table.tr>
                </x-base.table.thead>
                <x-base.table.tbody>
                    @php
                        //  $jobs = DB::table('jobs')
                        //                 ->join('users', 'jobs.customer_id', '=', 'users.id')
                        //                 ->select('jobs.*', 'users.name')
                        //                 ->get();
                        // print_r($jobs);
                        // exit;
                    @endphp
                    @foreach ($getAssignedJob as $row)
                        <x-base.table.tr class="intro-x text-center">
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->id }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->name }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                <a href='{{ route('job.invoice', $row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->product }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->job_category }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->address }} {{ $row->city }} {{ $row->postal_code }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->supervisor_name }}
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


                    @endif
                    </x-base.table.td>
                    <x-base.table.td
                        class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">

                        @if ($row->technician_id != '0')
                            @php
                                $technicians = DB::table('technicians')
                                    ->where('id', $row->technician_id)
                                    ->first();
                                if (empty($getIn)) {
                                    echo '(' . $technicians->name . ')';
                                }
                            @endphp


                    </x-base.table.td>

                    </x-base.table.tr>
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
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is
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
@endsection
