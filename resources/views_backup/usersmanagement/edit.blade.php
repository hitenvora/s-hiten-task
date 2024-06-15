@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Update user</title>
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
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Update User</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
    <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">

            <form action='{{ route('user.update') }}' method="post" enctype="multipart/form-data">
                <input type="hidden" value='{{ $id }}' name='id'>
                <div class="input-form mt-3">
                    <label> Email </label>
                    <input name="email" type="text" required="required" class="form-control"
                        value="{{ $user->email }}" />
                </div>
                <div class="input-form mt-3">
                    <label> User Name </label>
                    <input name="username" type="text" required="required" class="form-control"
                        value="{{ $user->username }}" />
                </div>
                <div class="input-form mt-3">
                    <label> Name </label>
                    <input name="name" type="text" required="required" class="form-control"
                        value="{{ $user->name }}" />
                </div>
                <div class="input-form mt-3">
                    <label> Mobile No </label>
                    <input name="phone_no" type="text" required="required" class="form-control"
                        value="{{ $user->phone_no }}" />
                </div>
                <div class="input-form mt-3">
                    <label> Image </label>
                    <input name="image" type="file" class="form-control" />

                    @if ($user->image != '')
                        <img class="rounded-full" src="{{ asset('user_image/' . $user->image) }}"
                            alt="Midone Tailwind HTML Admin Template" height="100px" style="    height: 100px;"/>
                    @endif
                </div>

                @csrf

                <button class='btn btn-success mt-3 text-center' type='submit'>Update</button>

            </form>

        </div>
    </div>
    <script>
        // const inputElements = document.querySelectorAll('input[type="text"]');

        // function generateRandomValue() {
        //     return Math.random().toString(36).substring(2, 10); // Random alphanumeric string
        // }

        // inputElements.forEach((input) => {
        //     input.value = generateRandomValue();
        // });
    </script>
@endsection
@once
    @push('script')
        <script>
            $('body').on('click', '.btn_add_address', function() {
                alert();
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
