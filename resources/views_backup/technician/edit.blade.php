@extends('../layouts/side-menu')



@section('subhead')

    <title>Update technician</title>

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
    <div class="intro-y mt-8 flex items-center" style="margin-bottom:13px; margin-top:0px;">

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Edit technician</h2>

    </div>

    <div class="grid grid-cols-12 gap-6">

        <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <!-- BEGIN: Register Form -->
            <!-- BEGIN: Validation Form -->

              <form  action='{{ route('technician.update.profile') }}' method="post" enctype="multipart/form-data">

                @csrf

                <div class='grid-cols-12 grid'> 
                <div class='col-span-12 mr-5'>

                <img src={{ asset('technician_images/'.$technician->profile_image)}} height="100px" width="100px">

                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Profile </label>

                    <input  name="profile_image" type="file"  class="form-control"   />

                </div>
                </div>

                <input type="hidden" name="technician_id" value ={{ $technician->id}} >
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Name </label>

                    <input  name="name" type="text"  required="required" class="form-control"  value ="{{ $technician->name}}"  />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> User Name </label>

                    <input  name="user_name" type="text"  required="required" class="form-control"  value ="{{ $technician->user_name}}" />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Mobile No </label>

                    <input  name="mobile_no" type="text"  required="required" maxlength="10" minlength="10" class="form-control"  value ="{{ $technician->mobile_no}} " />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Aadhar No </label>

                    <input  name="aadhar_no" type="text"  required="required" class="form-control"   value ="{{ $technician->aadhar_no}}"  />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Password </label>

                    <input  name="password" type="password"    class="form-control"  />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Password Confirmation </label>

                    <input  name="password_confirmation" type="password"   class="form-control" />

                </div> 

                @if ($errors->has('password_confirmation'))

                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

               @endif
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Date Of Birth </label>

                    <input  name="dob" type="date"  required="required" class="form-control"  value ="{{ $technician->dob}}" />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Date Of Join </label>

                    <input  name="doj" type="date"  required="required" class="form-control"  value ="{{ $technician->doj}}"  />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Driving License No </label>

                    <input  name="driving_license_no" type="text"  required="required" class="form-control"  value ="{{ $technician->driving_license_no}}"  />

                </div>
                </div>

                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Monthly Salary </label>

                    <input  name="monthly_salary" type="text" value ="{{ $technician->monthly_salary}}"  required="required" class="form-control" />

                </div>
                </div>

                <div class='col-span-12 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;"> Address </label>

                    <input  name="address" type="text"  required="required" class="form-control"  value ="{{ $technician->address}}"  />

                </div>  
                </div>

                <button type="submit"

                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Update</button>

            </form> 

            {{-- <form action='{{ route('technician.add') }}' method="post" enctype="multipart/form-data">

                @csrf

                <div class="intro-x mt-8">

                    <img src={{ asset('technician_images/'.$technician->profile_image)}} height="100px" width="100px">

                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="file" name='profile_image'

                        placeholder="image"  />



                    <x-base.form-input class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px] " type="text" 

                        placeholder="Full name" name='name'

                        value ={{ $technician->name}}

                        />

                        @if ($errors->has('name'))

                        <span class="text-danger">{{ $errors->first('name') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="text"

                        placeholder="User Name" name='user_name' />

                        @if ($errors->has('user_name'))

                        <span class="text-danger">{{ $errors->first('user_name') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="text"

                        placeholder="Mobile No" name='mobile_no' />

                        @if ($errors->has('mobile_no'))

                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="text"

                        placeholder="Aadhar No" name='aadhar_no' />

                        @if ($errors->has('aadhar_no'))

                        <span class="text-danger">{{ $errors->first('aadhar_no') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="password"

                        placeholder="Password" name='password' />

                        @if ($errors->has('password'))

                        <span class="text-danger">{{ $errors->first('password') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="password"

                        placeholder="Password Confirmation" name='password_confirmation' />

                        @if ($errors->has('password_confirmation'))

                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>

                       @endif



                    <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="date"

                        placeholder="Date of Birth" name='dob' />

                        @if ($errors->has('dob'))

                        <span class="text-danger">{{ $errors->first('dob') }}</span>

                       @endif



                        <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="date"

                        placeholder="Date of Joining" name='doj' />

                        @if ($errors->has('doj'))

                        <span class="text-danger">{{ $errors->first('doj') }}</span>

                       @endif



                        <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="text"

                        placeholder="Driving License Number" name='driving_license_no' />

                        @if ($errors->has('driving_license_no'))

                        <span class="text-danger">{{ $errors->first('driving_license_no') }}</span>

                       @endif



                        <x-base.form-input class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]" type="text"

                        placeholder="Adress" name='address' />

                        @if ($errors->has('adress'))

                        <span class="text-danger">{{ $errors->first('adress') }}</span>

                       @endif



                </div>



                <div class="intro-x mt-5 text-center xl:mt-8 xl:text-left">

                    <x-base.button  type="submit" class="w-full px-4 py-3 align-top xl:mr-3 xl:w-32" variant="primary">

                        Update

                    </x-base.button>



                </div>

            

            </form> --}}

            <!-- END: Validation Form -->



            <!-- END: Register Form -->



            <!-- BEGIN: Success Notification Content -->

            <x-base.notification class="flex hidden" id="success-notification-content">

                <x-base.lucide class="text-success" icon="CheckCircle" />

                <div class="ml-4 mr-4">

                    <div class="font-medium">Registration success!</div>

                    <div class="mt-1 text-slate-500">

                        Please check your e-mail for further info!

                    </div>

                </div>

            </x-base.notification>

            <!-- END: Success Notification Content -->

            <!-- BEGIN: Failed Notification Content -->

            <x-base.notification class="flex hidden" id="failed-notification-content">

                <x-base.lucide class="text-danger" icon="XCircle" />

                <div class="ml-4 mr-4">

                    <div class="font-medium">Registration failed!</div>

                    <div class="mt-1 text-slate-500">

                        Please check the fileld form.

                    </div>

                </div>

            </x-base.notification>

            <!-- END: Failed Notification Content -->

        </div>

    </div>

    <script>

        const inputElements = document.querySelectorAll('input[type="text"]');



        // Function to generate a random value

        function generateRandomValue() {

            return Math.random().toString(36).substring(2, 10); // Random alphanumeric string

        }

    </script>

@endsection



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

