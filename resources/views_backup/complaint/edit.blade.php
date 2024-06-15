@extends('../layouts/side-menu')

@php

    // print_r($complaint);

    // exit;
@endphp

@section('subhead')
    <title>Update Complaint</title>
@endsection



@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }
    </style>
    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;margin-top:0px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Update Complaint</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action='{{ route('update.complaint') }}' method="post" enctype="multipart/form-data">
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Complaint No </label>
                            <input type='text' name='ref_no' value="{{ $complaint->ref_no }}" readonly
                                class='form-control'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Customer </label>
                            <select name="_customer_id" id="_user_id" class='form-control' required>
                                <option value=''>Select Customer</option>
                                @php
                                    use App\Models\User;
                                    $getUser = User::where('type', 3)->get();
                                @endphp
                                @foreach ($getUser as $user)
                                    @php
                                        $selected = '';
                                        if ($user->id == $complaint->_customer_id) {
                                            $selected = 'selected';
                                        }
                                    @endphp
                                    <option {{ $selected }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            @php
                                $getUserNumber = User::where('type', 3)
                                    ->where('id', '=', $complaint->_customer_id)
                                    ->first();
                            @endphp
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input name="mobile" id="mobile" type="text" value="{{ $getUserNumber->phone_no }}"
                                required="required" readonly class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Contract Location </label>
                            <select name="_customer_address_id" id="_customer_address_id" class='form-control'>
                                @php
                                    $getAddress = DB::table('customer_details')
                                        ->where('_user_id', $complaint->_customer_id)
                                        ->get();
                                @endphp
                                @foreach ($getAddress as $addres)
                                    @php
                                        $selected = '';
                                        if ($addres->id == $complaint->_customer_address_id) {
                                            $selected = 'selected';
                                        }
                                    @endphp
                                    <option {{ $selected }} value='{{ $addres->id }}'>{{ $addres->location_type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;">AMC Type</label>
                            <input type="text" id="amc_type" name="amc_type" value="{{ $complaint->amc_type }}" class="form-control" required
                                readonly>
                        </div>
                    </div>
                    <!-- <div class="col-span-6 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Name</label>
                        <input name="supervisor_name" type="text"  class="form-control" value="{{ $complaint->supervisor_name }}" required="required"/>
                    </div>
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Mobile No</label>
                        <input name="supervisor_mobile_no" type="text" value="{{ $complaint->supervisor_mobile_no }}" class="form-control" maxlength="10" minlength="10" required="required"/>
                    </div> -->
                    <div class="col-span-6 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Payment Type </label>
                        <select class='form-control ' name='payment_type'>
                            <option value='Cash' {{ $complaint->payment_type == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value='Card' {{ $complaint->payment_type == 'Card' ? 'selected' : '' }}>Pending</option>   
                            <option value='Free' {{ $complaint->payment_type == 'Free' ? 'selected' : '' }}>Free</option>   
                            <option value='AMC' {{ $complaint->payment_type == 'AMC' ? 'selected' : '' }}>AMC</option>                
                        </select>
                    </div>

                    <div class="col-span-6 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Priority </label>
                        <select class='form-control ' name='priority' required="required">
                            <option value='High' {{ $complaint->priority == 'High' ? 'selected' : '' }}>High</option>
                            <option value='Medium' {{ $complaint->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                            <option value='Low' {{ $complaint->priority == 'Low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>
                    <div class="col-span-6 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Job Category </label>
                        <select class='form-control ' name='job_category'>
                            @php
                                use App\Models\JobCategory;
                                $getCategory=JobCategory::all();
                            @endphp
                           @foreach ($getCategory as $cat)
                                <option value="{{ $cat->category }}" {{ $complaint->job_category == $cat->category ? 'selected' : '' }}>{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                     <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Name</label>
                        <input name="contact_p_name" type="text" placeholder="Contact Person Name" class="form-control" value="{{ $complaint->contact_p_name }}"/>
                    </div>
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Mobile No</label>
                        <input name="contact_p_mobile_no" type="text" placeholder="Contact Person Mobile No" class="form-control" maxlength="10" minlength="10" value="{{ $complaint->contact_p_mobile_no }}"/>
                    </div>
                    <!--<div class="input-form mt-3">-->

                    <!--    <label> Status </label>-->

                    <!--    <select name="status" id="status" class='form-control'>-->

                    <!--        <option @if ($complaint->status == 'Open') selected @endif value='Open'>Open</option>-->

                    <!--        <option @if ($complaint->status == 'Hold') selected @endif   value='Hold'>Hold</option>-->

                    <!--        <option @if ($complaint->status == 'Processing') selected @endif   value='Processing'>Processing</option>-->

                    <!--        <option @if ($complaint->status == 'Close') selected @endif  value='Close'>Close</option>-->

                    <!--    </select>-->

                    <!--</div>-->
                    <div class="col-span-12 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Supervisor </label>
                        <select class='form-control ' name='supervisor_id' required>
                            @php
                                use App\Models\Supervisor;
                                $getSupervisor=Supervisor::all();
                            @endphp
                            <option selected disabled>Select Supervisor</option>
                           @foreach ($getSupervisor as $supervisor)
                                <option value="{{ $supervisor->id }}" {{ $supervisor->id == $complaint->supervisor_id ? 'selected' : '' }}>{{ $supervisor->supervisor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Image </label>
                            <input type='file' name='image' class='form-control' {{ $complaint->image }}>
                        </div>
                    </div>
                    <div class='col-span-4 mr-5'>
                        <div class="input-form mt-3">
                            @if ($complaint->image != '')
                                <input type='hidden' value='{{ $complaint->image }}' name='image_name'>
                                <img src="{{ asset('complaint_image/' . $complaint->image) }}" style="height: 100px;">
                            @endif
                        </div>
                    </div>
                    <div class='col-span-2 mr-5'>
                    </div>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Complaint Description </label>
                            <input type='text' name='item_description' value="{{ $complaint->item_description }}"
                                class='form-control'>
                        </div>
                    </div>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Remark </label>
                            <input type='text' name='remark' class='form-control' value="{{ $complaint->remark }}">
                        </div>
                    </div>
                    <input type='hidden' value='{{ $complaint->id }}' name='id'>
                </div>
                @csrf
                <button class='btn btn-success btn_add_address mt-3' type='submit' style="margin-top:20px;">Update
                    Complaint</button>
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
                var User_Id = $(this).val();
                jQuery.ajax({
                    url: '{{ route('get.customer.address') }}',
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        User_Id: User_Id
                    },
                    success: function(result) {
                        jQuery('#_customer_address_id').empty();
                        jQuery('#amc_type').val('');

                        jQuery('#_customer_address_id').html(
                            '<option value="" selected="" disabled>Select Address</option>');
                        jQuery.each(result.getAddress, function(key, value) {
                            $("#_customer_address_id").append('<option value="' + value
                                .id + '">' + value.location_type + '</option>');
                        });
                    }
                });
            });
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
                        $("#mobile").val(result);
                    }
                });


            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#_user_id').change(function() {
                    var selectedMobile = $('#_user_id option:selected').data('mobile');
                    $('#customerMobile').val(selectedMobile);
                });
            });
        </script>
        <script>
            $('body').on('change', '#_customer_address_id', function() {
                var Address_Id = $(this).val();
                jQuery.ajax({
                    url: '{{ route('get.customer.amc') }}',
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        Address_Id: Address_Id
                    },
                    success: function(result) {
                        if (result == 'null') {
                            $("#amc_type").val('No AMC');
                        } else {
                            $("#amc_type").val(result.amc_type);
                        }
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
