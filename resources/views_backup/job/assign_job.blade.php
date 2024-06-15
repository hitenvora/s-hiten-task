@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Assign Job</title>
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
        <h2 class="mr-auto text-lg font-medium"  style="font-size:22px;">Assign Job to Technician</h2>
    </div>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-12" style="padding: 20px 32px;border: 1px solid #e1dede;border-radius: 6px;box-shadow: 0 3px 10px rgb(69 14 33 / 20%);background: white;border-top: 7px solid #164e63;">

            <form action='{{ route('job.update.assign_technician') }}' method="post" enctype="multipart/form-data">
                <input type='hidden' name='id' value='{{ $id }}' >
                <div class='grid-cols-12 grid'> 
                <div class='col-span-5 mr-5'>
                <div class="input-form mt-3">

                    <label style="font-weight:600; line-height:30px;">Job Ref No</label>
                    <input type='text' readonly class='form-control' name='job_ref_no' value='{{ $job->job_ref_no }}'>
                </div>
                </div>

                <div class='col-span-5 mr-5'>
                <div class="input-form mt-3">
                    <label class='w-100' style="font-weight:600; line-height:30px;"> Technicians </label>
                    <select class='form-control' name='technician_id' required>
                            <option value=''>Select Technician </option>
                        @php
                          $getTechni=DB::table('technicians')->get();
                        @endphp
                        @foreach ($getTechni as $resTech)
                            @php
                                $selected="";
                                if($job->technician_id==$resTech->id)
                                {
                                    $selected="selected";
                                }
                            @endphp
                            <option {{ $selected }} value='{{ $resTech->id }}'>{{ $resTech->name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                @csrf
                <div class='col-span-2 mr-5'>
                <button class='btn btn-success btn_add_address mt-3' type='submit' style="margin-top:40px;">Assign</button>
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
