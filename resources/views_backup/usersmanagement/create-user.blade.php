@extends('../layouts/' . $layout)

@section('subhead')
    <title>create complaine</title>
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
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create User</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">


               <!-- BEGIN: Register Form -->
               <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                    <div
                        class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                        <!-- <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                            Sign Up
                        </h2> -->
                        <div class="intro-x mt-2 text-center text-slate-400 dark:text-slate-400 xl:hidden">
                            A few more clicks to sign in to your account. Manage all your
                            e-commerce accounts in one place
                        </div>
                        <form action='{{ route('user.add') }}' method="post" enctype="multipart/form-data">
                        <div class="intro-x mt-8">
                            <x-base.form-input
                                class="intro-x block min-w-full px-4 py-3 xl:min-w-[350px] "
                                type="text"
                                placeholder="Email"
                                name='email'
                            />

                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="text"
                                placeholder="User Name"
                                name='user_name'
                            />
                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="text"
                                placeholder=" Name"
                                name='name'
                            />
                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="text"
                                placeholder="Mobile No"
                                name='phone_no'
                            />

                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="file"
                                placeholder="image"
                                name='image'
                            />
                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="password"
                                placeholder="Password"
                                name='password'
                            />
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                            <div class="intro-x mt-3 grid h-1 w-full grid-cols-12 gap-4">
                                <div class="col-span-3 h-full rounded bg-success"></div>
                                <div class="col-span-3 h-full rounded bg-success"></div>
                                <div class="col-span-3 h-full rounded bg-success"></div>
                                <div class="col-span-3 h-full rounded bg-slate-100 dark:bg-darkmode-800"></div>
                            </div>
                            <a
                                class="intro-x mt-2 block text-xs text-slate-500 sm:text-sm"
                                href=""
                            >
                                What is a secure password?
                            </a>
                            <x-base.form-input
                                class="intro-x mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                type="text"
                                placeholder="Password Confirmation"
                                name='password_confirmation'
                            />
                        </div>

                        <div class="intro-x mt-5 text-center xl:mt-8 xl:text-left">
                            <x-base.button
                                class="w-full px-4 py-3 align-top xl:mr-3 xl:w-32"
                                variant="primary"
                            >
                                Register
                            </x-base.button>

                        </div>
                        @csrf
                    </form>
                    </div>
                </div>
                <!-- END: Register Form -->

            <!-- BEGIN: Success Notification Content -->
            <x-base.notification
                class="flex hidden"
                id="success-notification-content"
            >
                <x-base.lucide
                    class="text-success"
                    icon="CheckCircle"
                />
                <div class="ml-4 mr-4">
                    <div class="font-medium">Registration success!</div>
                    <div class="mt-1 text-slate-500">
                        Please check your e-mail for further info!
                    </div>
                </div>
            </x-base.notification>
            <!-- END: Success Notification Content -->
            <!-- BEGIN: Failed Notification Content -->
            <x-base.notification
                class="flex hidden"
                id="failed-notification-content"
            >
                <x-base.lucide
                    class="text-danger"
                    icon="XCircle"
                />
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
