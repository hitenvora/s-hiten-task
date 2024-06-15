@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')
    <title>Detail Job</title>
@endsection



@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }
    </style>
    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Customer Detail</h2>

    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Customer Name </label>
                    <input name="customer_name" value="{{ $job->customer[0]->name }}" type="text" required="required"
                        class="form-control" readonly />
                </div>
                <div class="col-span-5 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Number </label>
                    <input name="job_ref_no" value="{{ $job->customer[0]->phone_no }}" type="text" required="required"
                        class="form-control" readonly />
                </div>

                <div class="col-span-12 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Address </label>
                    <input name="address" value="{{ $job->customer[0]->customer_details[0]->address }}" type="text"
                        required="required" class="form-control" readonly />
                </div>
            </div>
        </div>
    </div>



    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Complaint Detail</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Complaint No </label>
                    <input name="job_ref_no" value="{{ $job->job_ref_no }}" type="text" required="required"
                        class="form-control" readonly />
                </div>

                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Helper </label>
                    <input name="customer_name" value="{{ $job->helper_data->name }}" type="text" required="required"
                        class="form-control" readonly />
                </div>
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Priority </label>
                    <input name="address" value="{{ $job->customer[0]->customer_details[0]->address }}" type="text"
                        required="required" class="form-control" readonly />
                </div>
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Status </label>
                    <input name="status" value="{{ $job->status }}" type="text"
                    required="required" class="form-control" readonly />
                </div>
            </div>
        </div>
    </div>


    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Superwiser Detail</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Name </label>
                    <input name="job_ref_no" value="{{ $job->supervisor_name }}" type="text" required="required"
                        class="form-control" readonly />
                </div>
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Number </label>
                    <input name="customer_name" value="{{ $job->supervisor_mobile_no }}" type="text" required="required"
                        class="form-control" readonly />
                </div>
            </div>
        </div>
    </div>


    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Job Description</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                <div class="col-span-12 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Description </label>
                    <textarea name="description" id="" cols="50" rows="20" readonly class="form-control">
                        {{ $job->job_description }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>


    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Job Category</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Cagegory </label>
                    @php
                        $categories = explode(',', $job->job_category);
                    @endphp
                    @foreach($categories as $category)
                        <li>
                            {{ trim($category) }}
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Customer Review</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <div class="grid grid-cols-12">
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Customer Rating </label>
                    <input name="customer_rating" value="{{ $job->customer_rating }}" type="text" required="required"
                        class="form-control" readonly />
                </div>

                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Customer Review </label>
                    <input name="customer_name" value="{{ $job->customer_review }}" type="text" required="required"
                        class="form-control" readonly />
                </div>
                <div class="col-span-6 mt-3 p-2">
                    <label style="font-weight:600; line-height:30px;"> Customer Signature </label>
                   <img src="{{ asset('technician_images/'.$job->signature)}}" alt="" style="width: 150px">
                </div>
            </div>
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
