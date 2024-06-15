@extends('../layouts/side-menu')

@section('subhead')
    <title>List Of Invoice</title>
@endsection

@section('subcontent')
    <h2 class="mt-10 text-lg font-medium intro-y">List Of Invoice <button class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" id="btnExport" onclick="fnExcelReport3();" style="float: right;padding: 6px 12px;font-size: 15px;">Export</button></h2>
    <div class="grid grid-cols-12 gap-6 mt-5" style="width:100%;">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
        </div>
        <!-- BEGIN: Data List -->
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px]" style="margin-top:0px;">
                <x-base.table.thead class=''>
                    <x-base.table.tr>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Id
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Customer Name
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Invoice No
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Product
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Total Amount
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Payment Type
                        </x-base.table.th>
                        <x-base.table.th class=" border-b-0 whitespace-nowrap">
                            Action
                        </x-base.table.th>



                    </x-base.table.tr>
                </x-base.table.thead>
                <x-base.table.tbody >


                        @foreach ($getInvoice as $row)


                        <x-base.table.tr class="intro-x text-center">
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->id }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->name }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                              <a href='{{ route('view.invoice',$row->id) }}' target='_BLANK'>{{ $row->invoice_no }}</a>
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->product }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->total }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->payment_type }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                                <lable>
                            <a
                                                    class="mr-3 flex items-center"
                                                    href="{{ route('view.invoice',$row->id) }}"
                                                >
                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]: disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning mb-2 mr-1 mb-2 mr-1">View Invoice</button>
                                                </a> 
                                <!-- <a href='{{ route('view.invoice',$row->id) }}' class='btn btn-success btn-sm' target='_BLANK'>View Invoice</a> -->
                                <a
                                                    class="flex items-center text-danger"
                                                    href="{{ route('view.pdf',$row->id) }}"
                                                >
                                                <button data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-success border-success text-white dark:border-success mb-2 mr-1 mb-2 mr-1">View PDF</button>
                                                </a>
                                        </lable>
                                <!-- <a href='{{ route('view.pdf',$row->id) }}' class='btn btn-success btn-sm' target='_BLANK'>View PDF</a> -->
                            </x-base.table.td>

                        </x-base.table.tr>
                        @endforeach
                </x-base.table.tbody>
            </x-base.table>
        </div>

        <div style="display:none">
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px]" id="default-datatable">
                <x-base.table.thead class=''>
                    <x-base.table.tr>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Id
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Customer Name
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Invoice No
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Product
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Total Amount
                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            Payment Type
                        </x-base.table.th>
                      
                    </x-base.table.tr>
                </x-base.table.thead>
                <x-base.table.tbody >


                        @foreach ($getInvoice as $row)


                        <x-base.table.tr class="intro-x text-center">
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->id }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->name }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                              <a href='{{ route('view.invoice',$row->id) }}' target='_BLANK'>{{ $row->invoice_no }}</a>
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->product }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->total }}
                            </x-base.table.td>
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                               {{ $row->payment_type }}
                            </x-base.table.td>
                        </x-base.table.tr>
                        @endforeach
                </x-base.table.tbody>
            </x-base.table>
        </div>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->

        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <x-base.dialog id="delete-confirmation-modal">
        <x-base.dialog.panel>
            <div class="p-5 text-center">
                <x-base.lucide
                    class="w-16 h-16 mx-auto mt-3 text-danger"
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
                    class="w-24 mr-1"
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
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
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
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
    <!-- END: Delete Confirmation Modal -->

    <script>
   function fnExcelReport3()
   {
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('default-datatable'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea3.document.open("txt/html","replace");
        txtArea3.document.write(tab_text);
        txtArea3.document.close();
        txtArea3.focus(); 
        sa=txtArea3.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}
</script>
@endsection
