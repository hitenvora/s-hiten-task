@props(['layout' => 'side-menu'])



<!-- BEGIN: Top Bar -->

<div @class([
    'h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700',

    'dark:md:from-darkmode-800' => $layout == 'top-menu',

    "before:content-[''] before:absolute before:h-[65px] before:inset-0 before:top-0 before:mx-7 before:bg-primary/30 before:mt-3 before:rounded-xl before:hidden before:md:block before:dark:bg-darkmode-600/30",

    "after:content-[''] after:absolute after:inset-0 after:h-[65px] after:mx-3 after:bg-primary after:mt-5 after:rounded-xl after:shadow-md after:hidden after:md:block after:dark:bg-darkmode-600",
])>

    <div class="flex h-full items-center">

        <!-- BEGIN: Logo -->

        <a href="/?layout=top-menu" @class([
            '-intro-x hidden md:flex',
        
            'xl:w-[180px]' => $layout == 'side-menu',
        
            'xl:w-auto' => $layout == 'simple-menu',
        
            'w-auto' => $layout == 'top-menu',
        ])>

            <img class="w-6" src="{{ asset('sk_logo.jpg') }}" alt="Enigma Tailwind HTML Admin Template"
                style="width: 170px;border-radius: 15px;" />

            <span @class([
                'ml-3 text-lg text-white',
            
                'hidden xl:block' => $layout == 'side-menu',
            
                'hidden' => $layout == 'simple-menu',
            ])>



                {{-- SK Enterprise --}}

            </span>

        </a>

        <!-- END: Logo -->

        <!-- BEGIN: Breadcrumb -->

        <x-base.breadcrumb @class([
            'h-[45px] md:ml-10 md:border-l border-white/[0.08] dark:border-white/[0.08] mr-auto -intro-x',
        
            'md:pl-6' => $layout != 'top-menu',
        
            'md:pl-10' => $layout == 'top-menu',
        ]) light>

            {{-- <x-base.breadcrumb.link :index="0">Application</x-base.breadcrumb.link> --}}
        {{-- @php
            dd(\Request::route()->getName())
        @endphp --}}
            <x-base.breadcrumb.link :index="0">
                <a href="{{ route('dashboard-overview-1') }}">Dashboard</a>
            </x-base.breadcrumb.link>
            {{-- @if (\Request::route()->getName() == route('list.complaint'))           
                <x-base.breadcrumb.link :index="2" :active="true">
                    Complain
                </x-base.breadcrumb.link>
                <x-base.breadcrumb.link :index="3" :active="true">
                    Job List
                </x-base.breadcrumb.link>
                <x-base.breadcrumb.link :index="4" :active="true">
                    Category
                </x-base.breadcrumb.link>
                <x-base.breadcrumb.link :index="5" :active="true">
                    Calendar
                </x-base.breadcrumb.link>
            @endif --}}
            @if (\Request::route() && (\Request::route()->getName() == 'list.complaint' || \Request::route()->getName() == 'list.job' || \Request::route()->getName() == 'category' || \Request::route()->getName() == 'view.calendar' || \Request::route()->getName() == 'create.complaint' || \Request::route()->getName() == 'edit.complaint' || \Request::route()->getName() == 'job.create.form' || \Request::route()->getName() == 'job.assign_technician' || \Request::route()->getName() == 'subcategory' || \Request::route()->getName() == 'add.subcategory' || \Request::route()->getName() == 'edit.subcategory'))            
    <x-base.breadcrumb.link :index="1" :active="true">
        Job
    </x-base.breadcrumb.link>
    @if (\Request::route()->getName() == 'list.complaint')               
        <x-base.breadcrumb.link :index="2" :active="true">
            Complain
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'list.job')
        <x-base.breadcrumb.link :index="3" :active="true">
            Job List
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'category')
        <x-base.breadcrumb.link :index="4" :active="true">
            Category
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'subcategory')
        <x-base.breadcrumb.link :index="4" :active="true">
            Subcategory
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'add.subcategory')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('subcategory') }}">Subcategory</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Create
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'edit.subcategory')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('subcategory') }}">Subcategory</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Edit
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'view.calendar')
        <x-base.breadcrumb.link :index="5" :active="true">
            Calendar
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'create.complaint')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('list.complaint') }}">Complaint</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Create
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'edit.complaint')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('list.complaint') }}">Complaint</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Edit
        </x-base.breadcrumb.link>
    @elseif(\Request::route()->getName() == 'job.create.form')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('list.complaint') }}">Complaint</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Job Create
        </x-base.breadcrumb.link>
        @elseif(\Request::route() && \Request::route()->getName() == 'job.assign_technician')
        <x-base.breadcrumb.link :index="2" :active="true">
            <a href="{{ route('list.job', ['status' => $status ?? 'Complete']) }}">Job List</a>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link :index="3" :active="true">
            Assign Technician
        </x-base.breadcrumb.link>
    @endif

@endif


            @if (\Request::route()->getName() == 'upcuming-amc' || \Request::route()->getName() == 'panding-amc' || \Request::route()->getName() == 'expire-amc' || \Request::route()->getName() == 'list.amc' || \Request::route()->getName() == 'end-amc')           
            <x-base.breadcrumb.link :index="1" :active="true">
                AMC
            </x-base.breadcrumb.link>
            @if (\Request::route()->getName() == 'list.amc')               
                <x-base.breadcrumb.link :index="2" :active="true">
                    AMC
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'upcuming-amc')
                <x-base.breadcrumb.link :index="3" :active="true">
                    Up Coming AMC
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'panding-amc')
                <x-base.breadcrumb.link :index="4" :active="true">
                    Pending AMC
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'expire-amc')
                <x-base.breadcrumb.link :index="5" :active="true">
                    Expire AMC
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'end-amc')
                <x-base.breadcrumb.link :index="5" :active="true">
                    Ending AMC
                </x-base.breadcrumb.link>
            @endif
        @endif

        @if (\Request::route()->getName() == 'users' || \Request::route()->getName() == 'technician' || \Request::route()->getName() == 'helper')           
            <x-base.breadcrumb.link :index="1" :active="true">
                Users
            </x-base.breadcrumb.link>
            @if (\Request::route()->getName() == 'users')               
                <x-base.breadcrumb.link :index="2" :active="true">
                    Users
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'technician')
                <x-base.breadcrumb.link :index="3" :active="true">
                    Technician
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'helper')
                <x-base.breadcrumb.link :index="4" :active="true">
                    Helper
                </x-base.breadcrumb.link>
            @endif
        @endif

        @if (\Request::route()->getName() == 'customer.list')
            <x-base.breadcrumb.link :index="1" :active="true">
                Customer
            </x-base.breadcrumb.link>
        @endif

        @if (\Request::route()->getName() == 'view.product')
            <x-base.breadcrumb.link :index="1" :active="true">
                Product
            </x-base.breadcrumb.link>
        @endif

        @if (\Request::route()->getName() == 'create.invoice' || \Request::route()->getName() == 'list.invoice')           
            <x-base.breadcrumb.link :index="1" :active="true">
                Invoice
            </x-base.breadcrumb.link>
            @if (\Request::route()->getName() == 'create.invoice')               
                <x-base.breadcrumb.link :index="2" :active="true">
                    Create
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'list.invoice')
                <x-base.breadcrumb.link :index="3" :active="true">
                    View
                </x-base.breadcrumb.link>
            @endif
        @endif

        @if (\Request::route()->getName() == 'complainreport' || \Request::route()->getName() == 'technicianreport' || \Request::route()->getName() == 'amcreport')           
            <x-base.breadcrumb.link :index="1" :active="true">
                Report
            </x-base.breadcrumb.link>
            @if (\Request::route()->getName() == 'complainreport')               
                <x-base.breadcrumb.link :index="2" :active="true">
                    Complaint Report
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'technicianreport')
                <x-base.breadcrumb.link :index="3" :active="true">
                    Technician Report
                </x-base.breadcrumb.link>
            @elseif(\Request::route()->getName() == 'amcreport')
                <x-base.breadcrumb.link :index="4" :active="true">
                    AMC Report
                </x-base.breadcrumb.link>
            @endif
        @endif
            
        </x-base.breadcrumb>

        <!-- END: Breadcrumb -->

        <!-- BEGIN: Search -->

        <div class="intro-x relative mr-3 sm:mr-6">

            {{-- <div class="search relative hidden sm:block">

                <x-base.form-input

                    class="w-56 rounded-full border-transparent bg-slate-200 pr-8 shadow-none transition-[width] duration-300 ease-in-out focus:w-72 focus:border-transparent dark:bg-darkmode-400"

                    type="text"

                    placeholder="Search..."

                />

                <x-base.lucide

                    class="absolute inset-y-0 right-0 my-auto mr-3 h-5 w-5 text-slate-600 dark:text-slate-500"

                    icon="Search"

                />

            </div> --}}

            <a class="relative text-white/70 sm:hidden" href="">

                <x-base.lucide class="h-5 w-5 dark:text-slate-500" icon="Search" />

            </a>

            <x-base.transition class="search-result absolute right-0 z-10 mt-[3px] hidden" selector=".show"
                enter="transition-all ease-linear duration-150" enterFrom="mt-5 invisible opacity-0 translate-y-1"
                enterTo="mt-[3px] visible opacity-100 translate-y-0" leave="transition-all ease-linear duration-150"
                leaveFrom="mt-[3px] visible opacity-100 translate-y-0" leaveTo="mt-5 invisible opacity-0 translate-y-1">

                <div class="box w-[450px] p-5">
                    <div class="mb-2 font-medium">Pages</div>
                    <div class="mb-5">
                        <a class="flex items-center" href="">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-success/20 text-success dark:bg-success/10">
                                <x-base.lucide class="h-4 w-4" icon="Inbox" />
                            </div>
                            <div class="ml-3">Mail Settings</div>
                        </a>
                        <a class="mt-2 flex items-center" href="">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-pending/10 text-pending">
                                <x-base.lucide class="h-4 w-4" icon="Users" />
                            </div>
                            <div class="ml-3">Users & Permissions</div>
                        </a>
                        <a class="mt-2 flex items-center" href="">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary/80 dark:bg-primary/20">
                                <x-base.lucide class="h-4 w-4" icon="CreditCard" />
                            </div>
                            <div class="ml-3">Transactions Report</div>
                        </a>
                    </div>

                    <div class="mb-2 font-medium">Users</div>
                    <div class="mb-5">
                        @foreach (array_slice($fakers, 0, 4) as $faker)
                            <a class="mt-2 flex items-center" href="">
                                <div class="image-fit h-8 w-8">
                                    <img class="rounded-full" src="{{ Vite::asset($faker['photos'][0]) }}"
                                        alt="Midone Tailwind HTML Admin Template" />
                                </div>
                                <div class="ml-3">{{ $faker['users'][0]['name'] }}</div>
                                <div class="ml-auto w-48 truncate text-right text-xs text-slate-500">
                                    {{ $faker['users'][0]['email'] }}

                                </div>

                            </a>
                        @endforeach

                    </div>

                    <div class="mb-2 font-medium">Products</div>

                    @foreach (array_slice($fakers, 0, 4) as $faker)
                        <a class="mt-2 flex items-center" href="">

                            <div class="image-fit h-8 w-8">

                                <img class="rounded-full" src="{{ Vite::asset($faker['images'][0]) }}"
                                    alt="Midone Tailwind HTML Admin Template" />

                            </div>

                            <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>

                            <div class="ml-auto w-48 truncate text-right text-xs text-slate-500">

                                {{ $faker['products'][0]['category'] }}

                            </div>

                        </a>
                    @endforeach

                </div>

            </x-base.transition>

        </div>

        <!-- END: Search -->



        <!-- BEGIN: Main Color Switcher -->

        <div class="mt-10 z-50 flex items-center justify-center h-12 px-5 mb-10 border rounded-full shadow-md box mr-5">

            <div class="hidden mr-4 text-slate-600 dark:text-slate-200 sm:block">

                Color Scheme

            </div>

            <a class="{{ $colorScheme == 'default' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }} mr-1 block h-8 w-8 cursor-pointer rounded-full border-4 bg-cyan-900 hover:border-slate-200"
                href="{{ route('color-scheme-switcher', ['color_scheme' => 'default']) }}"></a>

            <a class="{{ $colorScheme == 'theme-1' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }} mr-1 block h-8 w-8 cursor-pointer rounded-full border-4 bg-blue-800 hover:border-slate-200"
                href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-1']) }}"></a>

            <a class="{{ $colorScheme == 'theme-2' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }} mr-1 block h-8 w-8 cursor-pointer rounded-full border-4 bg-blue-900 hover:border-slate-200"
                href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-2']) }}"></a>

            <a class="{{ $colorScheme == 'theme-3 ' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }} mr-1 block h-8 w-8 cursor-pointer rounded-full border-4 bg-emerald-900 hover:border-slate-200"
                href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-3 ']) }}"></a>

            <a class="{{ $colorScheme == 'theme-4' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }} block h-8 w-8 cursor-pointer rounded-full border-4 bg-indigo-900 hover:border-slate-200"
                href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-4']) }}"></a>

        </div>

        <!-- END: Main Color Switcher -->



        <!-- BEGIN: Notifications -->
  @php 
                $notificationcount = DB::table('local_notification_user')->count();
                @endphp
        <x-base.popover class="intro-x mr-4 sm:mr-6">

            <x-base.popover.button

                class="" style="color: white; font-size: 10px; display:flex;"

            >

                <x-base.lucide

                    class="h-5 w-5 dark:text-slate-500"

                    icon="Bell"

                /><span style="color: red;font-size: 10px;position: absolute;top: -8px;background: white;right: -9px;font-weight: 600;border-radius: 11px;line-height: 15px;padding: 0px 4px;">{{$notificationcount}}</span>


            </x-base.popover.button> 

            <x-base.popover.panel class="mt-2 w-[280px] p-5 sm:w-[350px]" style="
            width: 367px;
            overflow-y: scroll;
            height: 416px;">

                <div class="mb-5 font-medium">Notifications</div>
                @php
                    $notification = DB::table('local_notification_user')
                        ->orderby('id', 'DESC')
                        ->limit(5)
                        ->get();
                @endphp
                @foreach ($notification as $key)
                    @php
                        $technicians = DB::table('technicians')
                            ->where('id', $key->noti_user_id)
                            ->first();
                    @endphp

                    <div @class(['cursor-pointer relative flex items-center', 'mt-5' => $key])>

                        <div class="image-fit relative mr-1 h-12 w-12 flex-none">
                            @if ($technicians)
                            <img class="rounded-full"
                                src="{{ 'https://demo.vruttiitsolutions.com/technician_images/' . $technicians->profile_image }}"
                                alt="Midone Tailwind HTML Admin Template" />
                            @else
                            <img class="rounded-full"
                                src="https://dummyimage.com/300.png/fff"
                                alt="Midone Tailwind HTML Admin Template" />
                            @endif

                            <div
                                class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white bg-success dark:border-darkmode-600">

                            </div>

                        </div>

                        <div class="ml-2 overflow-hidden">

                            <div class="flex items-center">

                                <a class="mr-5 truncate font-medium" href="">

                                    {{ $technicians->name }}

                                </a>

                                <div class="ml-auto whitespace-nowrap text-xs text-slate-400">

                                </div>

                            </div>

                            <div class="mt-0.5 w-full text-slate-500">

                                {{ $key->noti_msg }}

                            </div>

                        </div>

                    </div>
                @endforeach
                
                <div class='cursor-pointer relative flex items-center' style=" border-top: 1px solid #ddd; margin-top: 10px;padding-top: 10px;">
                    <a class="mr-2 shadow-md transition duration-300 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24"  href="{{ route('del.notification')}}" style="padding: 6px 3px;font-size: 12px;">
                            Clear All
                    </a>
                </div>

            </x-base.popover.panel>

        </x-base.popover>

        <!-- END: Notifications -->

        <!-- BEGIN: Account Menu -->

        <x-base.menu>

            <x-base.menu.button
                class="image-fit zoom-in intro-x block h-8 w-8 scale-110 overflow-hidden rounded-full shadow-lg">

                <img src={{ asset('default-logo.png') }} alt="Midone Tailwind HTML Admin Template" />

            </x-base.menu.button>

            <x-base.menu.items
                class="relative mt-px w-56 bg-primary/80 text-white before:absolute before:inset-0 before:z-[-1] before:block before:rounded-md before:bg-black">

                <x-base.menu.header class="font-normal">

                    {{-- <div class="font-medium">{{ $fakers[0]['users'][0]['name'] }}</div> --}}

                    <div class="font-medium">{{ Auth::user() ? Auth::user()->name : 'Adimn' }}</div>

                    {{-- <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">

                        {{ $fakers[0]['jobs'][0] }}

                    </div> --}}

                    <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">

                        Admin

                    </div>

                </x-base.menu.header>

                <x-base.menu.divider class="bg-white/[0.08]" />

                {{-- <x-base.menu.item class="hover:bg-white/5">

                    <x-base.lucide

                        class="mr-2 h-4 w-4"

                        icon="User"

                    /> Profile

                </x-base.menu.item> --}}

                {{-- <x-base.menu.item class="hover:bg-white/5">

                    <x-base.lucide

                        class="mr-2 h-4 w-4"

                        icon="Edit"

                    /> Add Account

                </x-base.menu.item> --}}

                {{-- <x-base.menu.item class="hover:bg-white/5">

                    <x-base.lucide

                        class="mr-2 h-4 w-4"

                        icon="Lock"

                    /> Reset Password

                </x-base.menu.item> --}}

                {{-- <x-base.menu.item class="hover:bg-white/5">

                    <x-base.lucide

                        class="mr-2 h-4 w-4"

                        icon="HelpCircle"

                    /> Help

                </x-base.menu.item> --}}

                {{-- <x-base.menu.divider class="bg-white/[0.08]" /> --}}

                <x-base.menu.item class="hover:bg-white/5">

                    <a href={{ route('admin.logout') }} class="mr-2 h-4 w-4"> Logout</a>

                    {{-- <x-base.lucide

                        class="mr-2 h-4 w-4"

                        icon="ToggleRight"

                        :href="route('admin.logout')"

                    /> Logout --}}

                </x-base.menu.item>

            </x-base.menu.Items>

        </x-base.menu>

        <!-- END: Account Menu -->



    </div>

</div>

<!-- END: Top Bar -->



@once

    @push('scripts')
        @vite('resources/js/components/top-bar/index.js')
    @endpush

@endonce
