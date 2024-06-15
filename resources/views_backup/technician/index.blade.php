@extends('../layouts/' .'side-menu')

@section('subhead')
    <title>Technician</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Manage Technician</h2>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <!-- <x-base.button
                class="mr-2 shadow-md"
                variant="primary"
            >
                Add New technician
            </x-base.button> -->
            <a data-tw-merge href="{{ route('create.technician') }}" class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style="width:200px;">Add New technician</a>
            {{-- <x-base.menu>
                <x-base.menu.button
                    class="!box px-2 btn_click"
                    as="x-base.button"
                >
                    <span class="flex h-5 w-5 items-center justify-center">
                        <x-base.lucide
                            class="h-4 w-4"
                            icon="Plus"
                        />
                    </span>
                </x-base.menu.button>
                <x-base.menu.items class="w-40">
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="Users"
                        /> Add Group
                    </x-base.menu.item>
                    <x-base.menu.item>
                        <x-base.lucide
                            class="mr-2 h-4 w-4"
                            icon="MessageCircle"
                        /> Send
                        Message
                    </x-base.menu.item>
                </x-base.menu.items>
            </x-base.menu> --}}
            <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0">
                <div class="relative w-56 text-slate-500">
                    <form method="get" action="/search-technician">
                        <x-base.form-input
                            class="!box w-56 pr-10"
                            type="text"
                            name="search"
                            placeholder="Search..."
                            value="{{isset($search) ? $search : '' }}"
                        />
                        <x-base.lucide
                            class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"
                            icon="Search"
                        />
                    </form>
                </div>
            </div>
        </div>
        @php
        if(Request::get('search') != '')
        {
            $value = Request::get('search');
          
            $getTechnician = DB::table('technicians')->Where('name', 'like', "%{$value}%")->orWhere('user_name', 'like', "%{$value}%")->orWhere('mobile_no', 'like', "%{$value}%")->orWhere('aadhar_no', 'like', "%{$value}%")->orWhere('dob', 'like', "%{$value}%")->orWhere('doj', 'like', "%{$value}%")->orWhere('driving_license_no', 'like', "%{$value}%")->orWhere('address', 'like', "%{$value}%")->orWhere('monthly_salary', 'like', "%{$value}%")->get();
        }
        else
        {
            $getTechnician = DB::table('technicians')->paginate();
        }
        @endphp
        <!-- BEGIN: Users Layout -->
        @foreach ($getTechnician as $data)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col items-center p-5 lg:flex-row">
                        <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">
                            <img
                                class="rounded-full"
                                src={{ asset('technician_images/'.$data->profile_image) }}
                                alt="Midone Tailwind HTML Admin Template"
                            />
                        </div>
                        <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">
                            <a
                                class="font-medium"
                                href=""
                            >
                                {{ $data->name }}
                            </a>
                            <div class="mt-0.5 text-xs text-slate-500">
                                {{ $data->user_name }}
                            </div>
                        </div>
                        <div class="mt-4 flex lg:mt-0">
                            <a href= {{ route('technician.edit.profile',$data->id)}} class="px-2 py-1" >
                                Edit
                            </a>
                        </div>
                        <!-- Index Page Not Found -->
                        <div class="mt-4 flex lg:mt-0">
                        <form action="{{ route('technician.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Delete Technisian')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1">
                                Delete
                            </button>  
                        </form>
                        </div>
                        <div class="mt-4 flex lg:mt-0">

                            <a href= {{ route('technician.profile',$data->id)}} class="px-2 py-1" >
                                Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
       

        <!-- BEGIN: Users Layout -->
        <!-- BEGIN: Pagination -->
        <!-- END: Pagination -->
    </div>
@endsection
@push('scripts')
<script>

    // $(".btn_click").click(function (e) {
    //     $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url : "",
    //     data : {'id' : 1},
    //     type : 'GET',
    //     dataType : 'json',
    //     success : function(result){

    //         console.log("===== " + result + " =====");

    //     }
    // });
    // });
 </script>
@endpush
