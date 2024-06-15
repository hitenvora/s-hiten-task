@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')
    <title>Create Job</title>
@endsection
@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }

        .error {
            color: red;
        }
    </style>
    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Job</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action='{{ route('job.create.add', ['complaint_id' => $Id]) }}' method="post" name="myForm"
                enctype="multipart/form-data" onsubmit="return validateForm()">
                @csrf
                @php
                    $job_ref_no = DB::table('jobs')->orderBy('id', 'desc')->value('job_ref_no');
                    $complaint = DB::table('complaints')->where('id', $Id)->first();
                    // dd($complaint);
                    if ($complaint !== null) {
                        $getAddress = DB::table('customer_details')
                            ->where('id', $complaint->_customer_address_id)
                            ->first();
                    }
                @endphp

                <div class="grid grid-cols-12">
                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Complaint No </label>
                        <input name="job_ref_no" value="{{ $job_ref_no + 1 ?? '' }}" type="text" required="required"
                            class="form-control" />
                        @error('job_ref_no')
                            <div class="alert alert-danger error">{{ $message }}</div>
                        @enderror
                    </div>

                    @php
                        use App\Models\User; // Import User model
                    @endphp

                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Customer Name </label>
                        @if ($complaint && $complaint->_customer_id)
                            @php
                                // Retrieve user data
                                $getUser = User::where('type', 3)
                                    ->where('id', $complaint->_customer_id)
                                    ->get();
                            @endphp

                            @foreach ($getUser as $user)
                                <input name="customer_id11" value="{{ $user->name }}" type="text" required="required"
                                    class="form-control" id="_user_id11" readonly />
                                <input name="customer_id" value="{{ $user->id }}" type="hidden" required="required"
                                    class="form-control" id="_user_id" readonly />
                            @endforeach
                        @endif
                    </div>

                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Address </label>
                        @if ($complaint && $complaint->_customer_address_id)
                            <input type="hidden" name="address" value="{{ $complaint->_customer_address_id }}">
                            <select formcontrolname="state" id="address"
                                class="form-control ng-untouched ng-pristine ng-invalid city_id" disabled="true">
                                <option selected="" disabled>Select Address</option>
                                @php
                                    $getAddress = DB::table('customer_details')
                                        ->where('_user_id', $complaint->_customer_id)
                                        ->get();
                                @endphp
                                @foreach ($getAddress as $ct)
                                    <option value="{{ $ct->id }}" @if ($complaint->_customer_address_id == $ct->id) selected @endif>
                                        {{ $ct->location_type }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="hidden" name="address" value="">
                            <select formcontrolname="state" id="address"
                                class="form-control ng-untouched ng-pristine ng-invalid city_id" disabled="true">
                                <option selected="" disabled>Select Address</option>
                            </select>
                        @endif
                    </div>
                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Priority </label>
                        <input type="text" name='priority' value="{{ $complaint->priority ?? '' }}" class="form-control"
                            readonly>
                    </div>
                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Name</label>
                        <input name="supervisor_name" type="text" class="form-control"
                            value="{{ $complaint->supervisor_name ?? '' }}" required="required" readonly />
                    </div>
                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Supervisor Mobile No</label>
                        <input name="supervisor_mobile_no" type="text" class="form-control"
                            value="{{ $complaint->supervisor_mobile_no ?? '' }}" maxlength="10" minlength="10"
                            required="required" readonly />
                    </div>

                    <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Job Category </label>
                        {{-- <input type="text" name='job_category' value="{{ $complaint->job_category ?? '' }}"
                            class="form-control"> --}}
                        <select class="form-control valid" name="job_category" aria-required="true" aria-invalid="false">
                            <option value="Copper piping" @if ('Copper piping' == $complaint->job_category) selected @endif>Copper piping
                            </option>
                            <option value="AC Check" @if ('AC Check' == $complaint->job_category) selected @endif>AC Check</option>
                            <option value="AC Service" @if ('AC Service' == $complaint->job_category) selected @endif>AC Service</option>
                            <option value="Ac Fitting/Refitting"@if ('Ac Fitting/Refitting' == $complaint->job_category) selected @endif>Ac
                                Fitting/Refitting</option>
                        </select>
                    </div>

                    <input name="status" type="hidden" class="form-control" value="Assine" />
                    {{-- <div class="col-span-2 mt-3 p-2">
                        <label style="font-weight:600; line-height:30px;"> Payment Type </label>
                        <input type="text" name="payment_type" value="{{ $complaint->payment_type ?? '' }}" class="form-control" readonly>
                        <select class="form-control  @error('payment_type') is-invalid @enderror" name="payment_type"
                            required="required">
                            <option selected disabled>Select Types</option>
                            <option value="Card">Card</option>
                            <option value="Cash">Cash</option>
                            <option value="Free">Free</option>
                            <option value="AMC">AMC</option>
                        </select>
                        @error('payment_type')
                            <div class="alert alert-danger error">Payment field is Required</div>
                        @enderror

                    </div> --}}

                    <div class="col-span-3 mt-3 p-2 payment_type">
                        <label class='w-100' style="font-weight:600; line-height:30px;">Payment Type</label>
                        <select class="form-control @error('payment_type') is-invalid @enderror" name="payment_type"
                            required="required">
                            <option selected disabled>Select Payment</option>

                            <option value="Card"@if ('Card' == $complaint->payment_type) selected @endif>Card</option>
                            <option value="Cash"@if ('Cash' == $complaint->payment_type) selected @endif>Cash</option>
                            <option value="Free"@if ('Free' == $complaint->payment_type) selected @endif>Free</option>
                            <option value="AMC"@if ('AMC' == $complaint->payment_type) selected @endif>AMC</option>

                        </select>
                        @error('payment_type')
                            <div class="alert alert-danger error">Payment field is Required</div>
                        @enderror
                    </div>

                    <div class="col-span-2 mt-3 p-2 hidden">
                        <label style="font-weight:600; line-height:30px;"> Estimated Cost </label>
                        <input name="estimated_cost" type="text" class="form-control" value="0" />
                    </div>

                    {{-- <div class="col-span-3 mt-3 p-2 technician_id hidden">

                        <label class='w-100' style="font-weight:600; line-height:30px;"> Technicians </label>
    
                            <select class='form-control' name='technician_id' required>
                                <option selected disabled>Select Technicians</option>
                                @php
                                    $getTechni = DB::table('technicians')->get();
                                @endphp
                                @foreach ($getTechni as $resTech)
                                    <option value='{{ $resTech->id }}'>{{ $resTech->name }}</option>
                @endforeach
                </select>
            </div> --}}

                    {{-- <div class="col-span-3 mt-3 p-2 technician_id hidden">
    
                        <label class='w-100' style="font-weight:600; line-height:30px;"> Helper </label>
                            <select class='form-control' name='helper_id' required>
                                <option value='0'>Select Helper</option>
                                @php
                                    $gethelper = DB::table('helper')->get();
                                @endphp
                                @foreach ($gethelper as $gethel)
                                    <option value='{{ $gethel->id }}'>{{ $gethel->name }}</option>
            @endforeach
            </select>
    </div> --}}
                    {{-- {{ dd($complaint) }} --}}

                    <div class="col-span-3 mt-3 p-2 technician_id">
                        <label class='w-100' style="font-weight:600; line-height:30px;">Technicians</label>
                        <select class="form-control @error('technician_id') is-invalid @enderror" name="technician_id"
                            required="required">
                            <option selected disabled>Select Technicians</option>
                            @php
                                $getTechni = DB::table('technicians')->get();
                            @endphp
                            @foreach ($getTechni as $resTech)
                                <option value='{{ $resTech->id }} '>

                                    {{ $resTech->name }}</option>
                            @endforeach
                        </select>

                        @error('technician_id')
                            <div class="alert alert-danger error">Technicial field is Required</div>
                        @enderror
                    </div>



                    <div class="col-span-3 mt-3 p-2 helper_id">
                        <label class='w-100' style="font-weight:600; line-height:30px;">Helper</label>
                        {{-- <select class='form-control' name='helper_id'> --}}
                        <select class="form-control @error('helper_id') is-invalid @enderror" name="helper_id"
                            required="required">
                            {{-- <option value='0'>Select Helper</option> --}}
                            <option selected disabled>Select Technicians</option>

                            @php
                                $gethelper = DB::table('helper')->get();
                            @endphp
                            @foreach ($gethelper as $gethel)
                                <option value='{{ $gethel->id }}'>{{ $gethel->name }}</option>
                            @endforeach
                        </select>
                        @error('helper_id')
                            <div class="alert alert-danger error">Helper field is Required</div>
                        @enderror
                    </div>

                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Name</label>
                        <input name="contact_p_name" type="text" value="{{ $complaint->contact_p_name ?? '' }}"
                            placeholder="Contact Person Name" class="form-control" />
                    </div>
                    <div class="col-span-6 mt-3 mr-5">
                        <label style="font-weight:600; line-height:30px;"> Contact Person Mobile No</label>
                        <input name="contact_p_mobile_no" type="text"
                            value="{{ $complaint->contact_p_mobile_no ?? '' }}" placeholder="Contact Person Mobile No"
                            class="form-control" maxlength="10" minlength="10" />
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Job Description </label>
                            <textarea name="job_description" class="form-control" id="" cols="30" rows="10" readonly>{{ $complaint->item_description ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Remark </label>
                            <textarea name="job_remark" class="form-control" id="" cols="30" rows="10"
                                placeholder="Optional" readonly>{{ $complaint->remark ?? '' }}</textarea>
                        </div>
                    </div>
                    <input name="status" type="hidden" class="form-control" value="3" />
                    @php
                        $logedData = auth()->user();
                    @endphp
                    <div class="col-span-12 mt-3 p-2">
                        @if ($complaint && $complaint->image)
                            <img src="{{ asset('complaint_image/' . $complaint->image) }}" alt=""
                                width="100px">
                        @endif
                    </div>

                    <div class="col-span-12 mt-3 p-2">
                        <button class='btn btn-success btn_add_address mt-4' type='submit'>Create Job</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@once

    @push('script')
        <script>
            $('body').on('click', '.btn_add_address', function() {

                //alert();

            });
        </script>
        <script>
            function validateForm() {
                let technicianId = document.forms["myForm"]["technician_id"].value;
                // console.log("technicianId", technicianId);
                if (technicianId == "") {
                    alert("Technician must be required");
                    return false;
                }
                // let paymentType = document.forms["myForm"]["payment_type"].value;
                // // console.log("paymentType", paymentType);
                // if (paymentType == "") {
                //     alert("Payment must be required");
                //     return false;
                // }


                // let paymentTypeSelect = document.forms["myForm"]["payment_type"];
                // let paymentType = paymentTypeSelect.value;
                // if (paymentType == "") {
                //     paymentTypeSelect.classList.add("is-invalid");
                //     return false;
                // } else {
                //     paymentTypeSelect.classList.remove("is-invalid");
                // }
            }
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
