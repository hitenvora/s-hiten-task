@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Create Category</title>
@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Manage Category</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            {{-- <a href="{{ route('add.category') }}"
                class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Add
                New Category</a> --}}
            <div class="mx-auto hidden text-slate-500 md:block">
            </div>
            <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0 flex flex-wrap items-center sm:flex-nowrap">
                <div class="relative w-56 text-slate-500">
                    <form method="get" action="/search-category">
                        <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..."
                            value="{{ isset($search) ? $search : '' }}" />
                        <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        @php
            use App\Models\JobCategory;
            if (Request::get('search') != '') {
                $value = Request::get('search');
                $getCategory = JobCategory::Where('category', 'like', "%{$value}%")
                    ->orWhere('price', 'like', "%{$value}%")
                    ->get();
            } else {
                $getCategory = JobCategory::all();
            }
            //  print_r($getCategory);
            //  exit;
        @endphp
        <!-- BEGIN: Users Layout -->
        @foreach ($getCategory as $data)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col items-center p-5 lg:flex-row">

                        <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">
                            <a class="font-medium" href="#">
                                {{ $data->category }}

                            </a>
                            <div class="mt-0.5 text-xs text-slate-500">
                                {{-- Rs. {{ $data->price }} --}}
                            </div>
                        </div>
                        <div class="mt-4 flex lg:mt-0">
                            <!--<a-->
                            <!--                            class="flex items-center text-danger"-->
                            <!--                            href="{{ route('del.category', ['id' => $data->id]) }}"-->
                            <!--                        >-->
                            <!--                        <x-base.lucide-->
                            <!--                                class="mr-1 h-4 w-4"-->
                            <!--                                icon="CheckSquare"-->
                            <!--                            />-->
                            <!--                            Delete-->
                            <!--                        </a>-->
                            <a href="{{ route('edit.category', ['Id' => $data->id]) }}">
                                <button data-tw-merge
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-warning hover:border-warning text-slate-900 dark:border-warning dark:text-slate-300 dark:hover:bg-darkmode-800/70 mb-2 mr-1">
                                    <i data-lucide="edit" width="15" height="15"
                                        class="stroke-1.5 h-5 w-8"></i>Edit</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- BEGIN: Users Layout -->
        <!-- BEGIN: Pagination -->
        {{-- <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
            <x-base.pagination class="w-full sm:mr-auto sm:w-auto">
                <x-base.pagination.link>
                    <x-base.lucide
                        class="h-4 w-4"
                        icon="ChevronsLeft"
                    />
                </x-base.pagination.link>
                <x-base.pagination.link>
                    <x-base.lucide
                        class="h-4 w-4"
                        icon="ChevronLeft"
                    />
                </x-base.pagination.link>
                <x-base.pagination.link>...</x-base.pagination.link>
                <x-base.pagination.link>1</x-base.pagination.link>
                <x-base.pagination.link active>2</x-base.pagination.link>
                <x-base.pagination.link>3</x-base.pagination.link>
                <x-base.pagination.link>...</x-base.pagination.link>
                <x-base.pagination.link>
                    <x-base.lucide
                        class="h-4 w-4"
                        icon="ChevronRight"
                    />
                </x-base.pagination.link>
                <x-base.pagination.link>
                    <x-base.lucide
                        class="h-4 w-4"
                        icon="ChevronsRight"
                    />
                </x-base.pagination.link>
            </x-base.pagination>
            <x-base.form-select class="!box mt-3 w-20 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </x-base.form-select>
        </div> --}}
        <!-- END: Pagination -->
    </div>
@endsection

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
