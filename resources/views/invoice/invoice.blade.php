@extends('../layouts/side-menu')

@section('subhead')
    <title>Invoice - SKE Admin</title>
@endsection

@section('subcontent')

@php
     $user = Auth::user();
    // print_r($getClientData);
// exit;
 //print_r($user);
@endphp
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Invoice</h2>
        @php
            //print_r($getJobData);
        @endphp
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <x-base.button
            class="mr-2 shadow-md"
            variant="primary"
            onclick="printInvoice()"
        >
            Print
        </x-base.button>
        </div>
    </div>
    <!-- BEGIN: Invoice -->
    
    <div class="intro-y box mt-5 overflow-hidden invoice" style="background:white;">
        @php 
        $string = $getJobData->job_category;
        $variableAry=explode(",",$string); 
        @endphp
        <table style=" width: 100%; height: 100%;">
        <tbody>
            <tr>
                <td colspan="2" style="border-bottom: 1px solid #ddd;">
                    <div class="flex flex-col px-5 pt-10 text-center sm:px-20 sm:pt-20 sm:text-left lg:flex-row lg:pb-20" style="padding: 30px;">
                        <div class="text-3xl font-semibold text-primary">INVOICE</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px;">
                        <img src="https://crm.skenterprisehvac.com/sk_logo.jpg" style="width:200px;margin-bottom: 15px;" />
                        <div class="mt-2 text-lg font-medium text-primary">
                            {{ $getJobData->job_ref_no }}
                        </div>
                        <div class="mt-1">{{ date('M d,Y',strtotime($getJobData->created_at)) }}</div>
                    </div>
                </td>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px; float:right;">
                        <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Client Details</div>
                        <div class="mt-2 text-lg font-medium text-primary">
                            {{ $getClientData->name }}
                        </div>
                        <div class="mt-1"><b>Email ID :</b> {{ $getClientData->email }}</div>
                        <div class="mt-1"><b>Mobile No. :</b> {{  $getClientData->phone_no }}.</div>

                        @php  $getDetails=DB::table('customer_details')->where('_user_id',$getClientData->id)->get();
                        @endphp
                        @foreach ($getDetails as $rowDetails)
                        <div class="mt-1"><b>Address :</b> {{  $rowDetails->address }}.</div>
                        @endforeach
                    </div>
                </td>
            </tr>
            @if ($getJobData->technician_id != '0')
           @php $technicians = DB::table('technicians')->where('id', $getJobData->technician_id)->first();@endphp
            <tr>
                <td colspan="2" style="border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 10px 30px;">
                        <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Technician Details</div>
                        <div class="mt-2 text-lg font-medium text-primary">
                            {{ $technicians->name }}
                        </div>
                        <div class="mt-1"><b>Mobile No. :</b> {{  $technicians->mobile_no }}.</div>
                        <div class="mt-1"><b>Aadhar No. :</b> {{ $technicians->aadhar_no }}</div>
                        <div class="mt-1"><b>Driving Licence No. :</b> {{ $technicians->driving_license_no }}</div>
                        <div class="mt-1"><b>Address :</b> {{ $technicians->address }}</div>
                    </div>
                </td>
            </tr>
            @endif

            <tr>
                <td colspan="2">
                   
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 20px 30px;">
                        <div class="text-base text-slate-500" style="font-weight: 300; font-size: 21px;   color: black;">Service Detail</div>
                        <div class="overflow-x-auto" style="margin-top:20px;">
                            <x-base.table>
                                <x-base.table.thead>
                                    <x-base.table.tr>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 dark:border-darkmode-400" style="border: 1px solid #ddd;  background: #ddd;">
                                            SERVICE NAME
                                        </x-base.table.th>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;  background: #ddd;">
                                            PRICE
                                        </x-base.table.th>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;  background: #ddd;">
                                            Quantity
                                        </x-base.table.th>
                                        <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;  background: #ddd;">
                                            Total
                                        </x-base.table.th>
                                    </x-base.table.tr>
                                </x-base.table.thead>
                                <x-base.table.tbody>
                                    @if (count($getJobItem) > 0)
                                        @foreach ($getJobItem as $data)
                                            @php
                                                $subcategory = \APP\Models\JobSubCategory::where('id',$data->subcategory)->first();
                                            @endphp
                                            <x-base.table.tr>
                                                <x-base.table.td class="border-b dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                    <div class="whitespace-nowrap font-medium">
                                                        {{ $subcategory->subcategory }}
                                                    </div>
                                                </x-base.table.td>

                                                <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                    {{ $data->price }}
                                                </x-base.table.td>
                                                <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                    {{ $data->quantity }}
                                                </x-base.table.td>
                                                <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                    {{ $data->total }}
                                                </x-base.table.td>
                                            </x-base.table.tr>
                                        @endforeach
                                    @else
                                        <x-base.table.tr>
                                            <x-base.table.td class="border-b dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                <div class="whitespace-nowrap font-medium">
                                                    N/A
                                                </div>
                                            </x-base.table.td>
                                        
                                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                N/A

                                            </x-base.table.td>

                                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                N/A

                                            </x-base.table.td>

                                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400" style="border-right: 1px solid #ddd;  border-left: 1px solid #ddd;  border-bottom: 1px solid #ddd; ">
                                                N/A

                                            </x-base.table.td>
                                        
                                        </x-base.table.tr>
                                    @endif

                                </x-base.table.tbody>
                            </x-base.table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px 30px 40px;">
                        <div class="mt-10 text-center sm:mt-0 sm:text-left">
                            <div class="text-base text-slate-500" style="color:black;">Payment Type : {{ $getJobData->payment_type }}</div>
                            <div class="text-base text-slate-500 text-primary" style="color:black;">Received Amount : {{ $getJobData->received_amount }}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="px-5 py-10 sm:px-16 sm:py-20" style="padding: 0px 30px 40px; float:right;">
                        <div class="text-center sm:ml-auto sm:text-right">
                            <div class="text-base text-slate-500"  style="color:black;">Total Amount</div>
                            <div class="mt-2 text-xl font-medium text-primary">
                                {{ $getJobData->bill_amount }}
                            </div>
                            <div class="mt-1">Taxes included</div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
        
    
        <!-- <div class="px-5 py-10 sm:px-16 sm:py-20">
            <div class="overflow-x-auto">
                <x-base.table>
                    <x-base.table.thead>
                        <x-base.table.tr>
                            <x-base.table.th class="whitespace-nowrap border-b-2 dark:border-darkmode-400">
                                PRODUCT NAME
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                QTY
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                PRICE
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap border-b-2 text-right dark:border-darkmode-400">
                                SUBTOTAL
                            </x-base.table.th>
                        </x-base.table.tr>
                    </x-base.table.thead>
                    <x-base.table.tbody>
                        <x-base.table.tr>
                            <x-base.table.td class="border-b dark:border-darkmode-400">
                                <div class="whitespace-nowrap font-medium">
                                    {{ $getJobData->product }}
                                </div>
                                <div class="mt-0.5 whitespace-nowrap text-sm text-slate-500">
                                    {{ $getJobData->product_model_details }}
                                </div>
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                               1
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                                {{ $getJobData->estimated_cost }}

                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right font-medium dark:border-darkmode-400">
                                {{ $getJobData->estimated_cost }}
                            </x-base.table.td>
                        </x-base.table.tr>

                    </x-base.table.tbody>
                </x-base.table>
            </div>
        </div> -->
       
    </div>
    <!-- END: Invoice -->
<style>

@media print {

    body * {
        visibility: hidden;
    }

    .invoice, .invoice * {
        visibility: visible;
    }

    .invoice {
        position: absolute;
        left: 0;
        top: 0;
    }
}

</style>
<script>
        function printInvoice() {
            var printContents = document.querySelector('.invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            var style = document.createElement('style');
            style.innerHTML = '@page { size: A4; margin: 0; }';
            document.head.appendChild(style);

            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
