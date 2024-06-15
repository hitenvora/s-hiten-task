@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Create Invoice</title>
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
        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Create Invoice</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">

            <form action='{{ route('add.invoice') }}' method="post" enctype="multipart/form-data">
                <div class='grid-cols-12 grid'>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Invoice No </label>
                            <input type='text' class='form-control' name='invoice_no'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Name </label>
                            <input type='text' class='form-control' name='name'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Email </label>
                            <input type='text' class='form-control' name='email'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Mobile No </label>
                            <input type='text' class='form-control' name='mobile_no'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Product </label>
                            <input type='text' class='form-control' name='product'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Product Details </label>
                            <input type='text' class='form-control' name='product_details'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Qty </label>
                            <input type='text' class='form-control' name='qty'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Price </label>
                            <input type='text' class='form-control' name='price'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Total Price </label>
                            <input type='text' class='form-control' name='total'>
                        </div>
                    </div>
                    <div class='col-span-6 mr-5'>
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Payment Type </label>
                            <select class='form-control' name='payment_type'>
                                <option value='Cash'>Cash</option>
                                <option value='Card'>Card</option>
                                <option value='Cheque'>Cheque</option>
                                <option value='Online'>Online</option>
                            </select>
                        </div>
                    </div>
                </div>
                @csrf
                <button class='btn btn-success btn_add_address mt-3' type='submit'>Add</button>
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
