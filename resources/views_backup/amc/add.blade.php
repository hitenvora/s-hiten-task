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
    <div class="intro-y flex items-center" style="margin-bottom:13px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create AMC</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action="{{ route('create.amc.form.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Customer </label>
                            <select name="_user_id" id="_user_id" class='form-control'>
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
                            <input type="text" id="mobile" name="mobile[]" value="" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Contract Location </label><br>
                            <select name="_customer_details_id[]" id="_customer_details_id" class='form-control select_tag' data-address-id="0">
                            </select>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;">AMC Type</label>
                            <select name="amc_type[]" id="amc_type" class='form-control'>
                                <option value='With Spare'>AMC With Spare</option>
                                <option value='Without Spare'>AMC Without Spare</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 ac_type0" data-acdetail-id="0">
                        <div class="grid-cols-12 grid">

                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Contract Duration </label>
                            <select name="contract_type[]" id="contract_type" class='form-control'>
                                <option value='12'>12 Month</option>
                            </select>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Contract Amount </label>
                            <input type='text' name='contract_amount[]' class='form-control contract_amount'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Total Visit </label>
                            <input type='text' name='visit[]' id='visit' class='form-control'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12">
                                <div class="input-form mt-3">
                                    <label for="start-date" style="font-weight:600; line-height:30px;">Start Date</label>
                                    <input name="start_date[]" type="date" required="required"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12" style="margin-top:20px;">
                        <div class='add_other_visit' style="margin-top:20px;display: contents;">
                        </div>
                    </div>
                </div>
                <div class='add_other_address'>
                </div>
                <button type="submit"
                    class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Register</button>
                <button class='btn btn-success btn_add_address' type='button'>Add-Address</button>
            </form>
            <div class="" style="display: flex;justify-content: space-between;">
                <h3></h3>
                <h2 class="text-primary" style="font-size: 20px;">Total: <span class="showTotalAmount">0</span></h2>
            </div>
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

        <script>
            $('body').on('change', '#_user_id', function() {
                var User_Id = $(this).val();
                jQuery.ajax({
                    url: '{{ route('get.customer.address') }}',
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        User_Id: User_Id
                    },
                    success: function(data) {
                        jQuery('#_customer_details_id').empty();
                        jQuery('#_customer_details_id').html('');
                        $("#_customer_details_id").append(
                            '<option selected disabled> Select Location</option>');
                        jQuery.each(data.getAddress, function(key, value) {
                            $("#_customer_details_id").append('<option value="' + value
                                .id + '">' + value.location_type + '</option>');
                        });
                    }
                });
            });
        </script>

        <script>
            $('body').on('change', '#_customer_details_id', function() {
                var Address_ID = $(this).val();
                var indexId =  $(this).data('address-id');
                // console.log(indexId);
                jQuery.ajax({
                    url: '{{ route('get.customer.acdetail') }}',
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        Address_ID: Address_ID
                    },
                    success: function(data) {
                        jQuery('.ac_type'+ indexId).empty();
                        jQuery('.ac_type'+ indexId).html('');
                        jQuery.each(data.getAddress, function(key, value) {
                            $(".ac_type" + indexId).append(
                                '<div class="grid-cols-12 grid" style="background: #efecec00;border-radius: 8px; margin-bottom: 15px;"><div class="col-span-3 mr-5 mt-3"><div class="input-form"> <label style="font-weight:600; line-height:30px;"> No Ac </label><input value="' +
                                value.no_ac +
                                '" readonly type="text" required="required" class="form-control" /></div></div><div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;"> No of Ton </label><input type="text" value="' +
                                value.no_of_ton +
                                '" readonly required="required" class="form-control" /></div></div><div class="col-span-3 mr-5 mt-3"><div class="input-form"><label style="font-weight:600; line-height:30px;">Type</label><input type="text" readonly required="required" value="' +
                                value.type + '" class="form-control" />' +
                                '</div></div><div class="col-span-3 mr-5 mt-3"><input name="actypes['+ indexId +'][]" type="checkbox" value="' +
                                value.id + '" style=" margin-top: 30px;" /></div></div>')
                        });
                    }
                });
            });
            $('form').submit(function() {
                // Check if at least one checkbox is checked
                if ($('input[name^="actypes["]:checked').length === 0) {
                    // No checkbox is checked, prevent form submission
                    alert('Please select at least one actypes checkbox.');
                    return false; // Prevent form submission
                }
                return true;
            });
        </script>

        <script>
            var typeIndex = 1;
            $('body').on('click', '.btn_add_address', function() {
                var originalElement = $(".select_tag");
                var clonedElement = originalElement.clone();
                clonedElement.attr('data-address-id', typeIndex);;
                clonedSelectHTML = clonedElement[0].outerHTML;
                $('.add_other_visit').append(
                    '<div class="grid-cols-12 grid"><div class="col-span-6 mr-5">' +
                    '<div class="input-form mt-3" >' +
                    '<label style="font-weight:600; line-height:30px;"> Contract Location </label><br>' +
                    clonedSelectHTML +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-6 mr-5">' +
                    '<div class="input-form mt-3">' +
                    '<label style="font-weight:600; line-height:30px;">AMC Type</label>' +
                    '<select name="amc_type[]" id="amc_type" class="form-control">' +
                    '<option value="With Spare">AMC With Spare</option>' +
                    '<option value="Without Spare">AMC Without Spare</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-12 ac_type'+ typeIndex +'">' +
                    '<div class="grid-cols-12 grid"></div>' +
                    '</div>' +
                    '<div class="col-span-6 mr-5">' +
                    '<div class="input-form mt-3">' +
                    '<label style="font-weight:600; line-height:30px;"> Contract Duration </label>' +
                    '<select name="contract_type[]" id="contract_type" class="form-control">' +
                    '<option value="12">12 Month</option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-6 mr-5">' +
                    '<div class="input-form mt-3">' +
                    '<label style="font-weight:600; line-height:30px;"> Contract Amount </label>' +
                    '<input type="text" name="contract_amount[]" class="form-control contract_amount">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-6 mr-5">' +
                    '<div class="input-form mt-3">' +
                    '<label style="font-weight:600; line-height:30px;"> Total Visit </label>' +
                    '<input type="text" name="visit[]" id="visit" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-6 mr-5">' +
                    '<div class="grid grid-cols-12 gap-6">' +
                    '<div class="col-span-12">' +
                    '<div class="input-form mt-3">' +
                    '<label style="font-weight:600; line-height:30px;">Start Date</label>' +
                    '<input name="start_date[]" type="date" required="required" class="form-control" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-span-12" style="margin-top:20px;">' +
                        '<button class="btn btn-success btn_remove_address" type="button" style=" margin-top: 30px;">Remove</button>' +
                    '</div></div>'
                );
                typeIndex++;
                
            });
            $('body').on('click', '.btn_remove_address', function () {
                $(this).closest('.grid-cols-12').remove();
            });
        </script>

        <script>
            $(document).ready(function() {
                $('body').on('input', '.contract_amount', function() {
                    var total = 0;
                    $('.contract_amount').each(function() {
                        var amount = parseFloat($(this).val()) || 0;
                        total += amount;
                    });
                    $('.showTotalAmount').text(total);
                    // Do something with the total value, for example, log it to the console
                    console.log('Total: ' + total);
                });
            });
            $('body').on('click', '.btn_remove_address', function () {
                var total = 0;
                $('.contract_amount').each(function() {
                    var amount = parseFloat($(this).val()) || 0;
                    total += amount;
                });
                $('.showTotalAmount').text(total);
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
