@extends('../layouts/side-menu')

@php

    // echo $layout;exit;

@endphp

@section('subhead')

    <title>Create Category</title>

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
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Category</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action='{{ route('add.category.db') }}' method="post" enctype="multipart/form-data">
            <div class='grid-cols-12 grid'> 
                <div class='col-span-5 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Category </label>
                    <input type='text' class='form-control' name='category'>
                </div>
                </div>
                <div class='col-span-5 mr-5'>
                <div class="input-form mt-3">
                    <label style="font-weight:600; line-height:30px;"> Price </label>
                    <input type='number' class='form-control' name='price'>
                </div>
                </div>
                @csrf
                <div class='col-span-2 mr-5'>
                <button class='btn btn-success btn_add_address mt-3' type='submit' style="margin-top: 40px;">Add</button>
                </div>
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

            $('body').on('click', '.btn_add_address', function() {

               // alert();

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

