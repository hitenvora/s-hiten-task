@extends('../layouts/' . 'side-menu')



@section('subhead')
    <title>Customer Profile</title>
@endsection



@section('subcontent')
    <div class="intro-y mt-8 flex items-center">

        <h2 class="mr-auto text-lg font-medium">Profile</h2>

    </div>

    <x-base.tab.group>

        <!-- BEGIN: Profile Info -->

        <div class="intro-y box mt-5 px-5 pt-5">

            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">

                <!--<div class="flex flex-1 items-center justify-center px-5 lg:justify-start">-->

                    <!--<div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">-->

                    <!--    <img class="rounded-full" src={{ asset('customer_image/demo.png') }}-->

                    <!--        alt="Midone Tailwind HTML Admin Template" />-->

                    <!--    <div-->

                    <!--        class="absolute bottom-0 right-0 mb-1 mr-1 flex items-center justify-center rounded-full bg-primary p-2">-->

                    <!--        <x-base.lucide class="h-4 w-4 text-white" icon="Camera" />-->

                    <!--    </div>-->

                    <!--</div>-->

                    <!--<div class="ml-5">-->

                    <!--    <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">-->

                    <!--        {{ $userData->name }}-->

                    <!--    </div>-->

                    <!--    <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">-->

                    <!--        {{ $userData->phone_no }}-->

                    <!--    </div>-->

                    <!--    {{-- <div class="text-slate-500">{{ $fakers[0]['jobs'][0] }}</div> --}}-->

                    <!--</div>-->

                <!--</div>-->

                <div class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    
                    <div class="text-lg font-medium sm:whitespace-normal">
                        Customer Details
                    </div>
                    
                    <div style="border-top: 1px solid #d8d4d4;padding-left: 6px; margin-top: 21px;">

                        <div class="text-center font-medium lg:mt-3 lg:text-left" >

                           Name : {{ $userData->name }}

                        </div>

                        <div class="text-center font-medium lg:mt-3 lg:text-left">

                           Mobile No. : {{ $userData->phone_no }}

                        </div>

                        {{-- <div class="text-slate-500">{{ $fakers[0]['jobs'][0] }}</div> --}}

                    </div>

                    <div class="text-lg font-medium sm:whitespace-normal" style="padding-top: 20px;">
                        Location & AC Details
                    </div>
                    <div style="border-top: 1px solid #d8d4d4;padding: 6px;margin-top: 21px;">
                        @foreach ($getDetails as $row)
                            <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                                <div class="flex items-center truncate sm:whitespace-normal">
                                    Location : {{ $row->location_type }}
                                </div>
                            </div>
                            <div class=" flex flex-col items-center justify-center lg:items-start">
                                <div class="flex items-center truncate sm:whitespace-normal">
                                    Address : {{ $row->address }}
                                </div>
                            </div>
                            <div class=" flex flex-col items-center justify-center lg:items-start">
                                <div class="flex items-center truncate sm:whitespace-normal">
                                    Pincode : {{ $row->pincode }}
                                </div>
                            </div>
                            <div class="text-center font-medium lg:mt-3 lg:text-left">
                                AC Details
                            </div>
                            <div class="" style="border-bottom: 1px solid #d8d4d4;padding: 6px;margin-top: 7px;">
                                @php
                                    $acDetails = DB::table('ac_detail')
                                        ->where('address_id', $row->id)
                                        ->get();
                                @endphp
                                @foreach ($acDetails as $acDetail)
                                    <div class="flex flex-col items-center justify-center lg:items-start">
                                        <div class="flex items-center truncate sm:whitespace-normal">
                                            <b>Type :</b>&nbsp;&nbsp; {{ $acDetail->type }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center lg:items-start">
                                        <div class="flex items-center truncate sm:whitespace-normal">
                                            <b>No Of A/C :</b>&nbsp;&nbsp; {{ $acDetail->no_ac }}
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center lg:items-start"
                                        style="margin-bottom: 10px;">
                                        <div class="flex items-center truncate sm:whitespace-normal">
                                            <b>No of Ton :</b>&nbsp;&nbsp; {{ $acDetail->no_of_ton }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

        </div>







    </x-base.tab.group>
@endsection
