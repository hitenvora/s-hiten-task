@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Renew AMC</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Renew AMC</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">

            <form action='{{ route('create.amc.form.add') }}' method="post" enctype="multipart/form-data">


                <div class="input-form mt-3">
                    <label> Customer </label>
                    <select name="_user_id" id="_user_id" class='form-control'>
                        <option value=''>Select Customer</option>
                        @php
                            use App\Models\User;
                            $getUser = User::where('type', 3)->get();
                        @endphp
                        @foreach ($getUser as $user)
                            <option {{-- @selected($geAMCeData->_user_id == $user->id) --}} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="input-form mt-3">
                    <label> Contract Location </label>
                    <select name="_customer_details_id[]" id="_customer_details_id" class='form-control select' multiple>
                        @foreach ($GetCustomerDetail as $addres)
                            <option {{-- @selected(in_array($addres->id, $addresids)) --}} value='{{ $addres->id }}'>{{ $addres->location_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-form mt-3">
                    <label> Contract Type </label>
                    <select name="contract_type" id="contract_type" class='form-control'>
                        <option value='3'>@3 Month</option>
                        <option value='6'>@6 Month</option>
                        <option value='12'>@12 Month</option>
                    </select>
                </div>
                <div class="input-form mt-3">
                    <label> Contract Amount </label>
                    <input type='text' name='contract_amount' {{-- value="{{ $geAMCeData->contract_amount }}" --}} class='form-control'>
                </div>
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6'>
                        <div class="input-form mt-3">
                            <label> Start Date </label>
                            <input name="start_date" type="date" id='start-date' {{-- value="{{ date('Y-m-d') }}" --}}
                                required="required" class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 ml-3'>
                        <div class="input-form mt-3">
                            <label> End Date </label>
                            <input name="end_date" type="date" id='end-date' required="required" class="form-control" />
                        </div>
                    </div>

                </div>
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6'>
                        <div class="input-form mt-3">
                            <label> Visit Date </label>
                            <input name="visit_date[]" type="date" required="required" class="form-control" />
                        </div>
                    </div>
                    <div class='lg:col-span-2 lg:col-span-2 pt-5 mt-3 ml-3'>
                        <button type='button' class='btn btn-success btn_add_visite'>Add</button>
                    </div>
                </div>
                <div class='add_other_visit ml-5'>


                </div>

                @csrf

                <button class='btn btn-success btn_add_address mt-3' type='submit'><a href="">Register</a></button>

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
                    success: function(data) {
                        jQuery('#_customer_details_id').empty();
                        jQuery.each(data, function(index, option) {
                            $('#_customer_details_id').append('<option value="' + option.id + '">' +
                                option.location_type + '</option>');
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
