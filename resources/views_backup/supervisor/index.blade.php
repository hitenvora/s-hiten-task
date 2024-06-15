@extends('../layouts/' .'side-menu')

@section('subhead')
    <title>Helper</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Manage Supervisor</h2>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
          
            <a data-tw-merge href="{{ route('supervisor.create') }}" class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Add Supervisor</a>
         
            <!-- <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0">
                <div class="relative w-56 text-slate-500">
                    <form method="get" action="/search-helper">
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
            </div> -->
        </div>

        @php
        if(Request::get('search') != '')
        {
            $value = Request::get('search');
          
            $supervisor = DB::table('supervisors')->Where('supervisor_name', 'like', "%{$value}%")->orWhere('supervisor_mobile_no', 'like', "%{$value}%")->get();
        }
        else
        {
            $supervisor = DB::table('supervisors')->paginate();
        }
        @endphp
        <!-- BEGIN: Users Layout -->
        @foreach ($supervisor as $data)
        @php
            $complaint = DB::table('complaints')->where('supervisor_id',$data->id)->count();
        @endphp
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col items-center p-5 lg:flex-row">
                        <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">
                            <a
                                class="font-medium"
                                href=""
                            >
                                {{ $data->supervisor_name }}
                            </a>
                            <div class="mt-0.5 text-xs text-slate-500">
                                {{ $data->supervisor_mobile_no }}
                            </div>
                            <div class="mt-0.5 text-xs text-slate-500" style="font-size: 14px;margin-top: 6px;">
                              <b>Complaints:- </b>  {{ $complaint }}
                            </div>
                        </div>
                        <div class="mt-4 flex lg:mt-0">
                            <a href="{{ route('supervisor.edit',$data->id)}}" class="px-2 py-1" >
                                Edit
                            </a>
                        </div>
                        <!-- Index Page Not Found -->
                    </div>
                </div>
            </div>
        @endforeach
     
    </div>
@endsection
@push('scripts')

@endpush
