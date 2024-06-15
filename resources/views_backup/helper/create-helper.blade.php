@extends('../layouts/side-menu')

@section('subhead')
    <title>Create technician</title>
@endsection

@section('subcontent')
<style>
.btn-success {
    color: #fff !important;
    background-color: #164e63 !important;
    border-color: #164e63 !important;
}
</style>
<div class="intro-y mt-8 flex items-center" style="margin-bottom:13px; margin-top:0px;">
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Helper</h2>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">

            <!-- BEGIN: Register Form -->

            <!-- BEGIN: Validation Form -->
            <form  action='{{ route('helper.add') }}' method="POST" enctype="multipart/form-data">
                @csrf 
                <div class='grid-cols-12 grid'> 
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Name </label>
                    <input  name="name" type="text"  required="required" class="form-control"   />
                </div>
                </div>
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                    <input  name="mobile_no" type="text" maxlength="10" minlength="10"  required="required" class="form-control" />
                </div>
                </div>
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Aadhar No </label>
                    <input  name="aadhar_no" type="text" class="form-control" />
                </div>
                </div>
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Driving License No </label>
                    <input  name="driving_license_no" type="text" class="form-control" />
                </div>
                </div>
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Date Of Birth </label>
                    <input  name="dob" type="date" class="form-control" />
                </div>
                </div>
                <div class='col-span-6 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Date Of Join </label>
                    <input  name="doj" type="date" class="form-control" />
                </div>
                </div>
                
                <div class='col-span-12 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Address </label>
                    <input  name="address" type="text" class="form-control" />
                </div> 
                </div> 
                </div>
                <button type="submit"
                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5">Register</button>
            </form>

           
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
