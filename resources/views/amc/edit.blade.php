@extends('../layouts/side-menu')

@php

    // echo $layout;exit;

@endphp

@section('subhead')

    <title>Create AMC</title>

@endsection



@section('subcontent')
<style>
.btn-success {
    color: #fff !important;
    background-color: #164e63 !important;
    border-color: #164e63 !important;
}
</style>
    <div class="intro-y flex items-center"  style="margin-bottom:13px;">

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Update AMC</h2>

    </div>

    <div class="grid grid-cols-12 gap-6">

        <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px; border: 1px solid #e1dede; border-radius: 6px; box-shadow: 0 3px 10px rgb(69 14 33 / 20%); background: white;border-top: 7px solid #164e63;">



            <form action='{{ route('update.amc') }}' method="post" enctype="multipart/form-data">

            <input type='hidden' value='{{ $userData->id }}' name='id'>
            <div class='grid-cols-12 grid'> 

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Customer </label>
                    <select name="_user_id" id="_user_id" class='form-control'>

                        <option value=''>Select Customer</option>

                        @php

                            use App\Models\User;

                            $getUser=User::where('type', 3)->get();

                        @endphp

                       @foreach ($getUser as $user)

                       @php

                        $selected="";

                        if($user->id==$userData->_user_id)

                        {

                            $selected="selected";

                        }

                        @endphp

                            <option {{ $selected; }} value="{{ $user->id }}">{{ $user->name }}</option>

                        @endforeach



                    </select>

                </div>
                </div>
                
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Contract Location </label>
                    <!-- @php

                    $string = '['.$userData->_customer_details_id.']';
                    $selected = explode(",", $string);
                    @endphp -->

                    <!-- <select  name="_customer_details_id[]" id="_customer_details_id"  class='form-control select'>
                    @foreach($getAddress as $supplier)
                        <option value="{{ $supplier->id }}" {{ (in_array($supplier->id, $selected)) ? 'selected' : '' }}>{{ $supplier->location_type}}</option>
                    @endforeach
                    </select> -->
                    <select  name="_customer_details_id[]" id="_customer_details_id"  class='form-control'>
                    @foreach($getAddress as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $userData->_customer_details_id ? 'selected' : '' }}>{{ $supplier->location_type}}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;">AMC Type</label>

                    <select name="amc_type" id="amc_type" class='form-control'>

                        <option value='With Spare' {{ $userData->amc_type == 'With Spare' ? 'selected' : '' }}  >AMC With Spare</option>

                        <option value='Without Spare' {{ $userData->amc_type == 'Without Spare' ? 'selected' : '' }}>AMC Without Spare</option>

                    </select>

                </div>
                </div>

                <!-- <div class="input-form mt-3">

                    <label>AMC Type </label>

                    <input type='text' name="amc_type" id="amc_type" name='AMC With Spare' class='form-control'>

                </div> -->
                
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Contract Duration </label>

                    <select name="contract_type" id="contract_type" class='form-control'>

                        <!-- <option value='3' {{ $userData->contract_type == '3' ? 'selected' : '' }}>3 Month</option>

                        <option value='6' {{ $userData->contract_type == '6' ? 'selected' : '' }}>6 Month</option> -->

                        <option value='12' {{ $userData->contract_type == '12' ? 'selected' : '' }}>12 Month</option>

                    </select>

                </div>
                </div>
                
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Contract Amount </label>

                    <input type='text' name='contract_amount' value="{{ $userData->contract_amount }}" class='form-control'>

                </div>
                </div>
                
                <div class='col-span-6 mr-5'>
                @php 
                $vcount = DB::table('amc_visit')->where('_amc_id',$userData->id)->count();
                @endphp
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Total Visit </label>

                    <input type='text' name='visit' id='visit' value="{{$vcount}}" class='form-control'>

                </div>
                </div>

                <div class='col-span-12 mr-5'>
                <div class="grid grid-cols-12 gap-6">

                    <div class="col-span-12">

                        <div class="input-form mt-3">

                            <label for="start-date" style="font-weight:600; line-height:30px;">Start Date</label>

                            <input name="start_date" type="date" id="start-date" value="{{ $userData->start_date }}"  required="required" class="form-control"/>

                        </div>

                    </div>

                    {{-- <div class="col-span-6">

                        <div class="input-form mt-3">

                            <label for="end-date" style="font-weight:600; line-height:30px;">End Date</label>

                            <input name="end_date" type="date" id="end-date" required="required"  value="{{ $userData->end_date }}" class="form-control"/>

                        </div>

                    </div> --}}

                </div>
                </div>

                <!-- <div class='grid-cols-12 grid'>

                    <div class='col-span-6'>

                        <div class="input-form mt-3">

                            <label> Visit Date </label>

                            <input name="visit_date[]" type="date" class="form-control" />

                        </div>

                    </div>

                    <div class='lg:col-span-2 lg:col-span-2 pt-5 mt-3 ml-10'>

                        <button type='button' class='btn btn-success btn_add_visite ml-10'>Add</button>

                    </div>

                </div> -->
                <div class="col-span-12">
                <div class='add_other_visit' style="display:contents">

                </div>
                </div>

                <div class="col-span-12" style="margin-top:20px;">
                @php

                $i=1;

                @endphp

                @foreach ($getDetails as $key => $rowDetails)

                <div class='grid-cols-12 grid'>

                    <div class='col-span-6'>

                        <div class="input-form mt-3">

                            <label> Visit Date </label>

                            <input type='hidden' name='visit_id[{{ $i }}]' value="{{ $rowDetails->id }}">

                            <input name="visit_date1[{{ $key }}]" type="date" required="required" class="form-control" value='{{ $rowDetails->visit_date }}' />

                        </div>

                    </div>

                    <div class='lg:col-span-2 lg:col-span-2 pt-5 mt-3 ml-10'>

                    <a class="btn btn-success"  href="{{ route('del.amc.address',['id'=>$rowDetails->id]) }}">Remove</a>

                    </div>

                </div>

                @endforeach
                </div>

                @csrf



            <!-- <button class='btn btn-success btn_add_address mt-3' type='submit'><a href="/amc">Register</a></button> -->
            <button class='btn btn-success btn_add_address mt-3' type='submit'>Register</button>



            </form>



        </div>

    </div>

    <script>

        // const inputElements = document.querySelectorAll('input[type="text"]');



        // function generateRandomValue() {

        //     return Math.random().toString(36).substring(2, 10);

        // }



        // inputElements.forEach((input) => {

        //     input.value = generateRandomValue();

        // });

    </script>

@endsection

@once

    @push('script')

    <script>



        $('body').on('change', '#_user_id', function() {

        // alert();

        var User_Id=$(this).val();

                jQuery.ajax({

                    url: '{{ route('get.customer.address') }}',

                    type: "POST",

                    data: {

                            _token:"{{ csrf_token() }}",

                            User_Id:User_Id

                        },

                    success:function(data){

                        jQuery('#_customer_details_id').empty();

                        // jQuery.each(data, function(index, option) {

                        //     $('#_customer_details_id').append('<option value="' + option.id + '">' + option.location_type + '</option>');

                        // });

                        jQuery('#_customer_details_id').html('');
                            jQuery.each(data.getAddress, function (key, value) {
                                $("#_customer_details_id").append('<option value="' + value
                                    .id + '">' + value.location_type + '</option>');
                            });

                }

                });

        });

    </script>

    @endpush

@endonce

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

