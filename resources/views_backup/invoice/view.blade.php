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
            >
                Print
            </x-base.button>
            <x-base.menu class="ml-auto sm:ml-0">
                <x-base.menu.button
                    class="!box px-2"
                    as="x-base.button"
                >
                    <span class="flex h-5 w-5 items-center justify-center">
                        <x-base.lucide
                            class="h-4 w-4"
                            icon="Plus"
                        />
                    </span>
                </x-base.menu.button>
                <x-base.menu.items class="w-40">
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="File"
                        /> Export Word
                    </x-base.menu.item>
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="File"
                        /> Export PDF
                    </x-base.menu.item>
                </x-base.menu.items>
            </x-base.menu>
        </div>
    </div>
    <!-- BEGIN: Invoice -->
    <div class="intro-y box mt-5 overflow-hidden">
        <div class="flex flex-col px-5 pt-10 text-center sm:px-20 sm:pt-20 sm:text-left lg:flex-row lg:pb-20">
            <div class="text-3xl font-semibold text-primary">INVOICE</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-xl font-medium text-primary">{{ $user->name }}</div>
                <div class="mt-1">{{ $user->email }}</div>
            </div>
        </div>
        <div class="flex flex-col border-b px-5 pt-10 pb-10 text-center sm:px-20 sm:pb-20 sm:text-left lg:flex-row">
            <div>
                <div class="text-base text-slate-500">Client Details</div>
                <div class="mt-2 text-lg font-medium text-primary">
                    {{ $getInvoice->name }}
                </div>
                <div class="mt-1"> {{ $getInvoice->email }}</div>
                <div class="mt-1">{{  $getInvoice->mobile_no }}.</div>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-base text-slate-500">Receipt</div>
                <div class="mt-2 text-lg font-medium text-primary">
                    #{{ $getInvoice->invoice_no }}
                </div>
                <div class="mt-1">{{ date('M d,Y',strtotime($getInvoice->created_at)) }}</div>
            </div>
        </div>
        <div class="px-5 py-10 sm:px-16 sm:py-20">
            <div class="overflow-x-auto">
                <x-base.table>
                    <x-base.table.thead>
                        <x-base.table.tr>
                            <x-base.table.th class="whitespace-nowrap border-b-2 dark:border-darkmode-400">
                                DESCRIPTION
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
                                    {{ $getInvoice->product }}
                                </div>
                                <div class="mt-0.5 whitespace-nowrap text-sm text-slate-500">
                                    {{ $getInvoice->product_details }}
                                </div>
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                               1
                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right dark:border-darkmode-400">
                                {{ $getInvoice->price }}

                            </x-base.table.td>
                            <x-base.table.td class="w-32 border-b text-right font-medium dark:border-darkmode-400">
                                {{ $getInvoice->total }}
                            </x-base.table.td>
                        </x-base.table.tr>

                    </x-base.table.tbody>
                </x-base.table>
            </div>
        </div>
        <div class="flex flex-col-reverse px-5 pb-10 sm:flex-row sm:px-20 sm:pb-20">
            <div class="mt-10 text-center sm:mt-0 sm:text-left">
                <div class="text-base text-slate-500">Payment Type : {{ $getInvoice->payment_type }}</div>

            </div>
            <div class="text-center sm:ml-auto sm:text-right">
                <div class="text-base text-slate-500">Total Amount</div>
                <div class="mt-2 text-xl font-medium text-primary">
                    {{ $getInvoice->total }}
                </div>
                <div class="mt-1">Taxes included</div>
            </div>
        </div>
    </div>
    <!-- END: Invoice -->
@endsection
