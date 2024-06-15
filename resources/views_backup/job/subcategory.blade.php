@extends('../layouts/side-menu')
@php
    // echo $layout;exit;
@endphp
@section('subhead')
    <title>Create SubCategory</title>
@section('subcontent')
    .
    <style>
        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #164E63;
            /* Updated color */
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #164E63;
            /* Updated color */
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #164E63;
            /* Updated color */
        }
    </style>

    <style>
        .dropbtn {
            background-color: #164e63;
            margin-left: 7px;
            border-radius: 3px;
            color: white;
            padding: 8px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #164e63;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0px;
            top: 40px
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #ddd;
        }

        .show {
            display: block;
        }
    </style>
    <h2 class="intro-y mt-10 text-lg font-medium">Manage SubCategory</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">

            <a href="{{ route('add.subcategory') }}"
                class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24">Add
                New Subcategory</a>

            <div class="mx-auto hidden text-slate-500 md:block">

            </div>
            <div class="mt-3 w-full sm:mt-0 sm:ml-auto sm:w-auto md:ml-0 flex flex-wrap items-center sm:flex-nowrap">
                <div class="relative w-56 text-slate-500">
                    <form method="get" action="/subcategory">
                        <x-base.form-input class="!box w-56 pr-10" type="text" name="search" placeholder="Search..."
                            value="{{ isset($search) ? $search : '' }}" />
                        <x-base.lucide class="absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4" icon="Search" />
                    </form>
                </div>
                <div class="">
                    <button type="button"
                            class="text-center transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;amp;:hover:not(:disabled)]:border-opacity-90 [&amp;amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mt-5 mt-5"
                            style="margin-top: 2px; margin-left: 10px;" onclick="location.href='{{ route('subcategory') }}'">Clear</button>
                </div>
            </div>

        </div>
    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        @php
            use App\Models\JobCategory;

            if (Request::get('search') != '') {
                $value = Request::get('search');
                $subcategories = DB::table('job_subcategories')->where('subcategory', 'like', "%{$value}%")->orderBy('id', 'desc')->get();
            } else {
                $subcategories = DB::table('job_subcategories')->orderBy('id', 'desc')->get();
            }
        @endphp
        <!-- END: Pagination -->
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table" style="margin-top: 0px;">
                <x-base.table.thead class=''>
                    <x-base.table.tr>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            SL
                        </x-base.table.th>
                        <x-base.table.th class=" border-b-0 whitespace-nowrap">
                            Subcategory Name
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            Category Name
                        </x-base.table.th>
                        <x-base.table.th class=" border-b-0 whitespace-nowrap">
                            Price
                        </x-base.table.th>
                        <x-base.table.th class=" border-b-0 whitespace-nowrap">
                            Status
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            Action
                        </x-base.table.th>
                    </x-base.table.tr>
                </x-base.table.thead>
                <x-base.table.tbody>
                    @foreach ($subcategories as $key => $row)
                        @php
                            $category = DB::table('job_categories')
                                ->where('id', $row->job_category_id)
                                ->first();
                        @endphp
                        <x-base.table.tr class="intro-x">
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $key + 1 }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->subcategory }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $category->category }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                {{ $row->price }}
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                <input data-id="{{ $row->id }}"
                                    class="toggle-class transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;[type='radio']]:checked:bg-primary [&amp;[type='radio']]:checked:border-primary [&amp;[type='radio']]:checked:border-opacity-10 [&amp;[type='checkbox']]:checked:bg-primary [&amp;[type='checkbox']]:checked:border-primary [&amp;[type='checkbox']]:checked:border-opacity-10 [&amp;:disabled:not(:checked)]:bg-slate-100 [&amp;:disabled:not(:checked)]:cursor-not-allowed [&amp;:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&amp;:disabled:checked]:opacity-70 [&amp;:disabled:checked]:cursor-not-allowed [&amp;:disabled:checked]:dark:bg-darkmode-800/50 w-[38px] h-[24px] p-px rounded-full relative before:w-[20px] before:h-[20px] before:shadow-[1px_1px_3px_rgba(0,0,0,0.25)] before:transition-[margin-left] before:duration-200 before:ease-in-out before:absolute before:inset-y-0 before:my-auto before:rounded-full before:dark:bg-darkmode-600 checked:bg-primary checked:border-primary checked:bg-none before:checked:ml-[14px] before:checked:bg-white"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                    data-on="Active" data-off="InActive" {{ $row->status ? 'checked' : '' }}>
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600">
                                <a href="{{ route('edit.subcategory', $row->id) }}">
                                    <button
                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 hover:bg-opacity-90 hover:border-opacity-90 dark:hover:bg-opacity-70 dark:border-opacity-70 mb-2 mr-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="edit"
                                            data-lucide="edit" class="lucide lucide-edit stroke-1.5 h-5 w-8">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>Edit</button>
                                </a>
                            </x-base.table.td>
                        </x-base.table.tr>
                    @endforeach
                </x-base.table.tbody>
            </x-base.table>
        </div>
    </div>
@endsection


@endsection
@once
@push('vendors')
    @vite('resources/js/vendor/pristine/index.js')
    @vite('resources/js/vendor/toastify/index.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        jQuery(function($) {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('subcategory.status') }}',
                    data: {
                        'status': status,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            });
        });
    </script>
@endpush
@endonce

@once
@push('scripts')
    @vite('resources/js/pages/validation/index.js')
@endpush
@endonce
