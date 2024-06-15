@extends('../layouts/side-menu')

@php

    // echo $layout;exit;
@endphp

@section('subhead')
    <title>Edit Subcategory</title>
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

        <h2 class="mr-auto text-lg font-medium" style="font-size:22px;">Edit Subcategory</h2>

    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12"
            style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">
            <form action="{{ route('update.subcategory.db') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid-cols-12 grid">
                    <div class="col-span-4 mr-5">
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Category </label>
                            <select name="category" id="" class="form-control" required>
                                <option selected disabled>Select Category</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}" {{ $subcategory->job_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 mr-5">
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Subcategory </label>
                            <input type='text' class='form-control' name='subcategory' value="{{ $subcategory->subcategory }}" required>
                        </div>
                    </div>
                    <div class="col-span-4 mr-5">
                        <div class="input-form mt-3">
                            <label style="font-weight:600; line-height:30px;"> Price </label>
                            <input type="number" class="form-control" name="price" value="{{ $subcategory->price }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $subcategory->id }}">
                    <div class="col-span-12 mr-5">
                        <div class="input-form mt-3">
                            <button type="submit" class="btn btn-success btn_add_address mt-3">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
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
