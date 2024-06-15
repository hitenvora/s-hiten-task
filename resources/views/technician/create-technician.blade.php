@extends('../layouts/side-menu')



@section('subhead')
    <title>Create technician</title>
@endsection

<style>
    /* .form-control{

        display: block;

width: 100%;

height: calc(1.5em + 0.9rem + 2px);

padding: 0.45rem 0.9rem;

font-size: .875rem;

font-weight: 400;

line-height: 1.5;

color: #6c757d;

background-color: #fff;

background-clip: padding-box;

border: 1px solid #ced4da;

border-radius: 5px !important;

transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

    } */
</style>



@section('subcontent')
    <style>
        .btn-success {
            color: #fff !important;
            background-color: #164e63 !important;
            border-color: #164e63 !important;
        }
    </style>
    <style>
        /* Add this style to your HTML or include it in your CSS file */

        .input-group {
            position: relative;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        .toggle-password i {
            font-size: 18px;
            color: #555;
        }

        .error {
            color: red;
        }
    </style>
    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px; margin-top:0px;">

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create technician</h2>

    </div>

    <div class="grid grid-cols-12 gap-6">

        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <!-- BEGIN: Register Form -->
            <!-- BEGIN: Validation Form -->
            <form action='{{ route('technician.add') }}' method="post" enctype="multipart/form-data">
                @csrf
                <div class='grid-cols-12 grid'>
                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Profile </label>
                            <input name="profile_image" type="file" required="required" class="form-control" />
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Name </label>
                            <input name="name" type="text" required="required" class="form-control"   value="{{ old('name') }}" />
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> User Name </label>
                            <input name="user_name" type="text" required="required" value="{{ old('user_name') }}"
                                class="form-control" />
                            @error('user_name')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input name="mobile_no" type="text" required="required" maxlength="10" minlength="10"
                                class="form-control" value="{{ old('mobile_no') }}" />
                            @error('mobile_no')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Aadhar No </label>
                            <input name="aadhar_no" type="text" required="required" value="{{ old('aadhar_no') }}"
                                class="form-control" />
                            @error('aadhar_no')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Password </label>

                            <input name="password" type="password" required="required" class="form-control" />

                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Password Confirmation </label>

                            <input name="password_confirmation" type="password" required="required" class="form-control" />

                        </div>

                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div> --}}
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Password </label>
                            <div class="input-group">
                                <input name="password" id="password" type="password" required="required"
                                    class="form-control" />
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" toggle="#password">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Password Confirmation </label>
                            <div class="input-group">
                                <input name="password_confirmation" id="password_confirmation" type="password"
                                    required="required" class="form-control" />
                                <div class="input-group-append">
                                    <span class="input-group-text toggle-password" toggle="#password_confirmation">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>

                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Date Of Birth </label>

                            <input name="dob" type="date" required="required"   value="{{ old('dob') }}" class="form-control" />

                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Date Of Join </label>

                            <input name="doj" type="date" required="required"  class="form-control"   value="{{ old('doj') }}" />

                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Driving License No </label>

                            <input name="driving_license_no" type="text" required="required" class="form-control"
                                value="{{ old('driving_license_no') }}" />
                            @error('driving_license_no')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Monthly Salary </label>

                            <input name="monthly_salary" type="text" required="required" class="form-control"   value="{{ old('monthly_salary') }}" />

                        </div>
                    </div>

                    <div class='col-span-12 mr-5'>
                        <div class="input-form mt-3">

                            <label style="font-weight:600; line-height:30px;"> Address </label>

                            <input name="address" type="text" required="required" class="form-control"   value="{{ old('address') }}" />

                        </div>
                    </div>
                    <button class='btn btn-success btn_add_address mt-3' type='submit'>Register</button>
            </form>
        </div>
    </div>
@endsection



@once
    @push('vendors')
        @vite('resources/js/vendor/pristine/index.js')

        @vite('resources/js/vendor/toastify/index.js')
    @endpush
@endonce



@once

    @push('scripts')
        <script src="https://kit.fontawesome.com/177b54f962.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).on('click', '.toggle-password', function() {
                var target = $($(this).attr('toggle'));
                var icon = $(this).find('i');

                // Toggle between 'text' and 'password'
                if (target.attr('type') === 'password') {
                    target.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    target.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        </script>
        @vite('resources/js/pages/validation/index.js')
    @endpush

@endonce
