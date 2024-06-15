@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Create Complaint</title>
@endsection

@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }
    </style>
    <CENTER>
        <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px; margin-top:0px;">
            <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Complaint</h2>
        </div>
    </CENTER>
    <div class="grid grid-cols-12 gap-6">

        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">

            <form action='{{ route('add.complaint') }}' method="post" enctype="multipart/form-data">
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Complaint No </label>
                            <input type='text' name='ref_no' value="<?php echo date('ymdHis'); ?>" readonly class='form-control'>
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
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;">Customer Mobile Number</label>
                            <input type="text" id="mobile" name="mobile" value="" class="form-control" required
                                readonly>
                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Contract Location </label>
                            <select formcontrolname="state" name="_customer_details_id" id="_customer_details_id"
                                class="form-control ng-untouched ng-pristine ng-invalid city_id" required>
                                <option selected="" disabled>Select Address</option>
                                @foreach ($getAddress as $ct)
                                    <option value="{{ $ct->id }}">{{ $ct->location_type }}</option>
                                @endforeach
                                </option>
                                <!---->
                            </select>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;">AMC Type</label>
                            <input type="text" id="amc_type" name="amc_type"  value="" class="form-control" required
                                readonly>
                        </div>
                    </div>
                    {{-- <div class="col-span-6 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Name</label>
                        <input name="supervisor_name" type="text"  class="form-control" required="required"/>
                    </div>
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Mobile No</label>
                        <input name="supervisor_mobile_no" type="text"  class="form-control" maxlength="10" minlength="10" required="required"/>
                    </div> --}}
                    <div class="col-span-6 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Payment Type </label>
                        <select class='form-control ' name='payment_type'>
                            <option value='Cash'>Cash</option>
                            <option value='Card'>Pending</option>        
                            <option value='Free'>Free</option>        
                            <option value='AMC'>AMC</option>                
                        </select>
                    </div>

                    <div class="col-span-6 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Priority </label>
                        <select class='form-control ' name='priority' required="required">
                            <option value='High'>High</option>
                            <option value='Medium'>Medium</option>
                            <option value='Low'>Low</option>
                        </select>
                    </div>
                    <input type="hidden" name="amcvisit_id" value="{{ $amcvisitID }}">
                    <div class="col-span-6 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Job Category </label>
                        <select class='form-control ' name='job_category'>
                            @php
                                use App\Models\JobCategory;
                                $getCategory=JobCategory::all();
                            @endphp
                           @foreach ($getCategory as $cat)
                                <option value="{{ $cat->category }}">{{ $cat->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Name</label>
                        <input name="contact_p_name" type="text" placeholder="Contact Person Name" class="form-control"/>
                    </div>
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Mobile No</label>
                        <input name="contact_p_mobile_no" type="text" placeholder="Contact Person Mobile No" class="form-control" maxlength="10" minlength="10"/>
                    </div>
                    
                    <div class="input-form">
                        <!-- New -->
                        <style>
                            / Hide the default radio input / .status {
                                display: none;
                            }

                            / Style the custom radio button / .radio-label {
                                display: inline-block;
                                margin-right: 10px;
                                position: relative;
                                padding-left: 30px;
                                cursor: pointer;
                                font-size: 16px;
                            }

                            .radio-custom {
                                position: absolute;
                                left: 0;
                                top: 0;
                                height: 20px;
                                width: 20px;
                                background-color: #fff;
                                border: 1px solid #ccc;
                                border-radius: 50%;
                            }

                            / Style the custom radio button when checked / .status:checked+.radio-custom::before {
                                content: "\2713";/ Checkmark character / display: block;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                font-size: 14px;
                                color: #007BFF;
                            }
                        </style>
                    </div>
                    <div class="input-form" hidden>
                        <label style="font-weight:600; line-height:30px;"> Status </label>
                        <select name="status" id="status" class='form-control' style="display: none;">
                            <option value='Open'>Open</option>
                        </select>
                    </div>
                    <div class="col-span-12 mr-5 mt-3">
                        <label style="font-weight:600; line-height:30px;"> Supervisor </label>
                        <select class='form-control ' name='supervisor_id' required>
                            @php
                                use App\Models\Supervisor;
                                $getSupervisor=Supervisor::all();
                            @endphp
                            <option selected disabled>Select Supervisor</option>
                           @foreach ($getSupervisor as $supervisor)
                                <option value="{{ $supervisor->id }}">{{ $supervisor->supervisor_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Image </label>
                            <input type='file' name='image' class='form-control'>
                        </div>
                    </div>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Complain description </label>
                            <input type='text' name='item_description' class='form-control' required>
                        </div>
                    </div>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Remark </label>
                            <input type='text' name='remark' class='form-control' placeholder="Optional">
                        </div>
                    </div>
                </div>
                @csrf

                <button class='btn btn-success btn_add_address mt-3' type='submit' style="margin-top:20px;">Create
                    Complaint</button>
            </form>

        </div>
        <div class="intro-y col-span-12 lg:col-span-3">
        </div>
    </div>
@endsection
@once
    @push('script')
        {{-- <script>
            const inputElement = document.querySelector('input[name="ref_no"]');

            function generateRandomValue() {
                return Math.floor(Math.random() * 1000000000000);
            }

            inputElement.value = generateRandomValue();
        </script> --}}
     
        @php
            $no = 1;
            do {
                $exists = DB::table('complaints')->where('ref_no', $no)->exists();
                // If it exists, increment the reference number.
                if ($exists) {
                    $no++;
                }
            } while ($exists);
        @endphp
        <script>
            const inputElement = document.querySelector('input[name="ref_no"]');
            function generateRandomValue() {
                return Math.floor(Math.random() * 1000000000000);
            }
            inputElement.value = "<?php echo $no; ?>";
        </script>
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

                        jQuery('#_customer_details_id').html(
                            '<option value="" selected="" disabled>Select Address</option>');
                        jQuery.each(result.getAddress, function(key, value) {
                            $("#_customer_details_id").append('<option value="' + value
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
            $('body').on('change', '#_customer_details_id', function() {
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
