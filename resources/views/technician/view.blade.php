@extends('../layouts/' . 'side-menu')



@section('subhead')

    <title>Technician Profile</title>

@endsection



@section('subcontent')
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

    background-color: #164E63; /* Updated color */

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

    border-bottom: 2px solid #164E63; /* Updated color */

}



.content-table tbody tr.active-row {

    font-weight: bold;

    color: #164E63; /* Updated color */

}
.search-input {
    padding: 10px;
    width: 200px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    margin-right: 10px;
}

/* Style for the search button */
.search-button {
    background-color: #007bff; /* Change the color to your preference */
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 14px;
}

/* Hover effect for the search button */
.search-button:hover {
    background-color: #0056b3; /* Change the color to a darker shade for hover effect */
}



</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTKicbGh6chqaLZTVHiFt889Mmwn29pio&sensor=true" type="text/javascript"></script>

<style type="text/css">
    .map {
    flex: 1;
    background: #f0f0f0;
}
    	#mymap {
      		border:1px solid red;
      		width: 800px;
      		height: 500px;
    	}
  	</style>

    <div class="intro-y mt-8 flex items-center">

        <h2 class="mr-auto text-lg font-medium">Profile Layout</h2>

    </div>

    <x-base.tab.group> 

        <!-- BEGIN: Profile Info -->

        <div class="intro-y box mt-5 px-5 pt-5">

            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">

                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">

                    <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">

                        <img

                            class="rounded-full"

                            src={{ asset('technician_images/'.$technician->profile_image)}}

                            alt="Technician"

                        />

                        <div

                            class="absolute bottom-0 right-0 mb-1 mr-1 flex items-center justify-center rounded-full bg-primary p-2">

                            <x-base.lucide

                                class="h-4 w-4 text-white"

                                icon="Camera"

                            />

                        </div>

                    </div>

                    <div class="ml-5">

                        <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">

                            {{ $technician->name }}

                        </div>

                        {{-- <div class="text-slate-500">{{ $fakers[0]['jobs'][0] }}</div> --}}

                    </div>

                </div>

                <div
 
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">

                    <div class="text-center font-medium lg:mt-3 lg:text-left" style="font-size: 17px;">

                        Contact Details

                    </div>

                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">

                        <div class="flex items-center truncate sm:whitespace-normal">

                            <x-base.lucide

                                class="mr-2 h-4 w-4"

                                icon="Mail"

                            />

                            {{$technician->user_name }}

                        </div>

                        {{-- <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            <x-base.lucide

                                class="mr-2 h-4 w-4"

                                icon="Instagram"

                            /> Instagram

                            {{ $fakers[0]['users'][0]['name'] }}

                        </div> --}}

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            <x-base.lucide

                                class="mr-2 h-4 w-4"

                                icon="phone"

                            /> Mobile

                            {{ $technician->mobile_no }}

                        </div>

                    </div>

                </div>

                <div

                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">

                    <div class="text-center font-medium lg:text-left" style="font-size: 17px;">

                        Salary Details

                    </div>

                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">

                        <div class="flex items-center truncate sm:whitespace-normal">

                        <b>Monthly Salary :</b>

                            {{$technician->monthly_salary }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                        <b> Daily Salary :</b>
                            @php $monthsalary = $technician->monthly_salary / 30; @endphp
                            {{ number_format($monthsalary,2) }}

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                        <b> Per Hour Salary :</b>

                            @php $perhoursalary = $monthsalary / 11; @endphp

                            {{ number_format($perhoursalary,2) }}

                            <!-- {{$diff_in_hours}} -->

                        </div>

                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">

                            @php 
                            $earnsalary = $diff_in_hours * $perhoursalary;
                            @endphp

                        <b>Monthly Earn Salary :</b>
                        <a href="{{ route('technician.profile1', $technician->id) }}">
                         {{ number_format($earnsalary,2) }} </a>
                       
                            <!-- {{$diff_in_hours}} -->

                        </div>

                    </div>

                </div>

                {{-- <div

                    class="mt-6 flex-1 border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-0 lg:pt-0">

                    <div class="text-center font-medium lg:mt-5 lg:text-left">

                        Sales Growth

                    </div>

                    <div class="mt-2 flex items-center justify-center lg:justify-start">

                        <div class="mr-2 flex w-20">

                            USP:

                            <span class="ml-3 font-medium text-success">+23%</span>

                        </div>

                        <div class="w-3/4">

                            <x-simple-line-chart-1

                                class="-mr-5"

                                height="h-[55px]"

                            />

                        </div>

                    </div>

                    <div class="flex items-center justify-center lg:justify-start">

                        <div class="mr-2 flex w-20">

                            STP: <span class="ml-3 font-medium text-danger">-2%</span>

                        </div>

                        <div class="w-3/4">

                            <x-simple-line-chart-2

                                class="-mr-5"

                                height="h-[55px]"

                            />

                        </div>

                    </div>

                </div> --}}

            </div>

            {{-- <x-base.tab.list

                class="flex-col justify-center text-center sm:flex-row lg:justify-start"

                variant="link-tabs"

            >

                <x-base.tab

                    id="dashboard-tab"

                    :fullWidth="false"

                    selected

                >

                    <x-base.tab.button class="cursor-pointer py-4">Dashboard</x-base.tab.button>

                </x-base.tab>

                <x-base.tab

                    id="account-and-profile-tab"

                    :fullWidth="false"

                >

                    <x-base.tab.button class="cursor-pointer py-4">

                        Account & Profile

                    </x-base.tab.button>

                </x-base.tab>

                <x-base.tab

                    id="activities-tab"

                    :fullWidth="false"

                >

                    <x-base.tab.button class="cursor-pointer py-4">

                        Activities

                    </x-base.tab.button>

                </x-base.tab>

                <x-base.tab

                    id="tasks-tab"

                    :fullWidth="false"

                >

                    <x-base.tab.button class="cursor-pointer py-4">Tasks</x-base.tab.button>

                </x-base.tab>

            </x-base.tab.list>

        </div> --}}

        {{-- <!-- END: Profile Info -->

        <x-base.tab.panels class="intro-y mt-5">

            <x-base.tab.panel

                id="dashboard"

                selected

            >

                <div class="grid grid-cols-12 gap-6">

                    <!-- BEGIN: Top Categories -->

                    <div class="intro-y box col-span-12 lg:col-span-6">

                        <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">

                            <h2 class="mr-auto text-base font-medium">

                                Top Categories

                            </h2>

                            <x-base.menu class="ml-auto">

                                <x-base.menu.button

                                    class="block h-5 w-5"

                                    href="#"

                                    tag="a"

                                >

                                    <x-base.lucide

                                        class="h-5 w-5 text-slate-500"

                                        icon="MoreHorizontal"

                                    />

                                </x-base.menu.button>

                                <x-base.menu.items class="w-40">

                                    <x-base.menu.item>

                                        <x-base.lucide

                                            class="mr-2 h-4 w-4"

                                            icon="Plus"

                                        /> Add

                                        Category

                                    </x-base.menu.item>

                                    <x-base.menu.item>

                                        <x-base.lucide

                                            class="mr-2 h-4 w-4"

                                            icon="Settings"

                                        />

                                        Settings

                                    </x-base.menu.item>

                                </x-base.menu.items>

                            </x-base.menu>

                        </div>

                        <div class="p-5">

                            <div class="flex flex-col sm:flex-row">

                                <div class="mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        Wordpress Template

                                    </a>

                                    <div class="mt-1 text-slate-500">

                                        HTML, PHP, Mysql

                                    </div>

                                </div>

                                <div class="flex">

                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">

                                        <x-simple-line-chart height="h-[30px]" />

                                    </div>

                                    <div class="text-center">

                                        <div class="font-medium">6.5k</div>

                                        <div class="mt-1.5 rounded bg-success/20 px-2 text-success">

                                            +150

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-5 flex flex-col sm:flex-row">

                                <div class="mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        Bootstrap HTML Template

                                    </a>

                                    <div class="mt-1 text-slate-500">

                                        HTML, PHP, Mysql

                                    </div>

                                </div>

                                <div class="flex">

                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">

                                        <x-simple-line-chart height="h-[30px]" />

                                    </div>

                                    <div class="text-center">

                                        <div class="font-medium">2.5k</div>

                                        <div class="mt-1.5 rounded bg-pending/10 px-2 text-pending">

                                            +150

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-5 flex flex-col sm:flex-row">

                                <div class="mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        Tailwind HTML Template

                                    </a>

                                    <div class="mt-1 text-slate-500">

                                        HTML, PHP, Mysql

                                    </div>

                                </div>

                                <div class="flex">

                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">

                                        <x-simple-line-chart height="h-[30px]" />

                                    </div>

                                    <div class="text-center">

                                        <div class="font-medium">3.4k</div>

                                        <div class="mt-1.5 rounded bg-primary/10 px-2 text-primary">

                                            +150

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- END: Top Categories -->

                    <!-- BEGIN: Work In Progress -->

                    <x-base.tab.group class="intro-y box col-span-12 lg:col-span-6">

                        <div

                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">

                            <h2 class="mr-auto text-base font-medium">

                                Work In Progress

                            </h2>

                            <x-base.menu class="ml-auto sm:hidden">

                                <x-base.menu.button

                                    class="block h-5 w-5"

                                    href="#"

                                    tag="a"

                                >

                                    <x-base.lucide

                                        class="h-5 w-5 text-slate-500"

                                        icon="MoreHorizontal"

                                    />

                                </x-base.menu.button>

                                <x-base.menu.items class="w-40">

                                    <x-base.menu.item

                                        class="w-full"

                                        id="work-in-progress-mobile-new-tab"

                                        target="work-in-progress-new"

                                        as="x-base.tab.button"

                                        unstyled

                                        selected

                                    >

                                        New

                                    </x-base.menu.item>

                                    <x-base.menu.item

                                        class="w-full"

                                        id="work-in-progress-mobile-last-week-tab"

                                        target="work-in-progress-last-week"

                                        as="x-base.tab.button"

                                        unstyled

                                        :selected="false"

                                    >

                                        Last Week

                                    </x-base.menu.item>

                                </x-base.menu.items>

                            </x-base.menu>

                            <x-base.tab.list

                                class="ml-auto hidden w-auto sm:flex"

                                variant="link-tabs"

                            >

                                <x-base.tab

                                    id="work-in-progress-new-tab"

                                    :fullWidth="false"

                                    selected

                                >

                                    <x-base.tab.button class="cursor-pointer py-5">

                                        New

                                    </x-base.tab.button>

                                </x-base.tab>

                                <x-base.tab

                                    id="work-in-progress-last-week-tab"

                                    :fullWidth="false"

                                    :selected="false"

                                >

                                    <x-base.tab.button class="cursor-pointer py-5">

                                        Last Week

                                    </x-base.tab.button>

                                </x-base.tab>

                            </x-base.tab.list>

                        </div>

                        <div class="p-5">

                            <x-base.tab.panels>

                                <x-base.tab.panel

                                    id="work-in-progress-new"

                                    selected

                                >

                                    <div>

                                        <div class="flex">

                                            <div class="mr-auto">Pending Tasks</div>

                                            <div>20%</div>

                                        </div>

                                        <x-base.progress class="mt-2 h-1">

                                            <x-base.progress.bar

                                                class="w-1/2 bg-primary"

                                                role="progressbar"

                                                aria-valuenow="0"

                                                aria-valuemin="0"

                                                aria-valuemax="100"

                                            ></x-base.progress.bar>

                                        </x-base.progress>

                                    </div>

                                    <div class="mt-5">

                                        <div class="flex">

                                            <div class="mr-auto">Completed Tasks</div>

                                            <div>2 / 20</div>

                                        </div>

                                        <x-base.progress class="mt-2 h-1">

                                            <x-base.progress.bar

                                                class="w-1/4 bg-primary"

                                                role="progressbar"

                                                aria-valuenow="0"

                                                aria-valuemin="0"

                                                aria-valuemax="100"

                                            ></x-base.progress.bar>

                                        </x-base.progress>

                                    </div>

                                    <div class="mt-5">

                                        <div class="flex">

                                            <div class="mr-auto">Tasks In Progress</div>

                                            <div>42</div>

                                        </div>

                                        <x-base.progress class="mt-2 h-1">

                                            <x-base.progress.bar

                                                class="w-3/4 bg-primary"

                                                role="progressbar"

                                                aria-valuenow="0"

                                                aria-valuemin="0"

                                                aria-valuemax="100"

                                            ></x-base.progress.bar>

                                        </x-base.progress>

                                    </div>

                                    <x-base.button

                                        class="mx-auto mt-5 block w-40"

                                        href=""

                                        as="a"

                                        variant="secondary"

                                    >

                                        View More Details

                                    </x-base.button>

                                </x-base.tab.panel>

                            </x-base.tab.panels>

                        </div>

                    </x-base.tab.group>

                    <!-- END: Work In Progress -->

                    <!-- BEGIN: Daily Sales -->

                    <div class="intro-y box col-span-12 lg:col-span-6">

                        <div

                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">

                            <h2 class="mr-auto text-base font-medium">Daily Sales</h2>

                            <x-base.menu class="ml-auto sm:hidden">

                                <x-base.menu.button

                                    class="block h-5 w-5"

                                    href="#"

                                    tag="a"

                                >

                                    <x-base.lucide

                                        class="h-5 w-5 text-slate-500"

                                        icon="MoreHorizontal"

                                    />

                                </x-base.menu.button>

                                <x-base.menu.items class="w-40">

                                    <x-base.menu.item>

                                        <x-base.lucide

                                            class="mr-2 h-4 w-4"

                                            icon="File"

                                        /> Download

                                        Excel

                                    </x-base.menu.item>

                                </x-base.menu.items>

                            </x-base.menu>

                            <x-base.button

                                class="hidden sm:flex"

                                variant="outline-secondary"

                            >

                                <x-base.lucide

                                    class="mr-2 h-4 w-4"

                                    icon="File"

                                /> Download

                                Excel

                            </x-base.button>

                        </div>

                        <div class="p-5">

                            <div class="relative flex items-center">

                                <div class="image-fit h-12 w-12 flex-none">

                                    <img

                                        class="rounded-full"

                                        src="{{ Vite::asset($fakers[0]['photos'][0]) }}"

                                        alt="Midone Tailwind HTML Admin Template"

                                    />

                                </div>

                                <div class="ml-4 mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        {{ $fakers[0]['users'][0]['name'] }}

                                    </a>

                                    <div class="mr-5 text-slate-500 sm:mr-5">

                                        Bootstrap 4 HTML Admin Template

                                    </div>

                                </div>

                                <div class="font-medium text-slate-600 dark:text-slate-500">

                                    +$19

                                </div>

                            </div>

                            <div class="relative mt-5 flex items-center">

                                <div class="image-fit h-12 w-12 flex-none">

                                    <img

                                        class="rounded-full"

                                        src="{{ Vite::asset($fakers[1]['photos'][0]) }}"

                                        alt="Midone Tailwind HTML Admin Template"

                                    />

                                </div>

                                <div class="ml-4 mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        {{ $fakers[1]['users'][0]['name'] }}

                                    </a>

                                    <div class="mr-5 text-slate-500 sm:mr-5">

                                        Tailwind HTML Admin Template

                                    </div>

                                </div>

                                <div class="font-medium text-slate-600 dark:text-slate-500">

                                    +$25

                                </div>

                            </div>

                            <div class="relative mt-5 flex items-center">

                                <div class="image-fit h-12 w-12 flex-none">

                                    <img

                                        class="rounded-full"

                                        src="{{ Vite::asset($fakers[2]['photos'][0]) }}"

                                        alt="Midone Tailwind HTML Admin Template"

                                    />

                                </div>

                                <div class="ml-4 mr-auto">

                                    <a

                                        class="font-medium"

                                        href=""

                                    >

                                        {{ $fakers[2]['users'][0]['name'] }}

                                    </a>

                                    <div class="mr-5 text-slate-500 sm:mr-5">

                                        Vuejs HTML Admin Template

                                    </div>

                                </div>

                                <div class="font-medium text-slate-600 dark:text-slate-500">

                                    +$21

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- END: Daily Sales -->

                    <!-- BEGIN: Latest Tasks -->

                    <x-base.tab.group class="intro-y box col-span-12 lg:col-span-6">

                        <div

                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">

                            <h2 class="mr-auto text-base font-medium">

                                Latest Tasks

                            </h2>

                            <x-base.menu class="ml-auto sm:hidden">

                                <x-base.menu.button

                                    class="block h-5 w-5"

                                    href="#"

                                    tag="a"

                                >

                                    <x-base.lucide

                                        class="h-5 w-5 text-slate-500"

                                        icon="MoreHorizontal"

                                    />

                                </x-base.menu.button>

                                <x-base.menu.items class="w-40">

                                    <x-base.menu.item

                                        class="w-full"

                                        id="latest-tasks-mobile-new-tab"

                                        target="latest-tasks-new"

                                        as="x-base.tab.button"

                                        unstyled

                                        selected

                                    >

                                        New

                                    </x-base.menu.item>

                                    <x-base.menu.item

                                        class="w-full"

                                        id="latest-tasks-mobile-last-week-tab"

                                        target="latest-tasks-last-week"

                                        as="x-base.tab.button"

                                        unstyled

                                        :selected="false"

                                    >

                                        Last Week

                                    </x-base.menu.item>

                                </x-base.menu.items>

                            </x-base.menu>

                            <x-base.tab.list

                                class="ml-auto hidden w-auto sm:flex"

                                variant="link-tabs"

                            >

                                <x-base.tab

                                    id="latest-tasks-new-tab"

                                    :fullWidth="false"

                                    selected

                                >

                                    <x-base.tab.button class="cursor-pointer py-5">

                                        New

                                    </x-base.tab.button>

                                </x-base.tab>

                                <x-base.tab

                                    id="latest-tasks-last-week-tab"

                                    :fullWidth="false"

                                    :selected="false"

                                >

                                    <x-base.tab.button class="cursor-pointer py-5">

                                        Last Week

                                    </x-base.tab.button>

                                </x-base.tab>

                            </x-base.tab.list>

                        </div>

                        <div class="p-5">

                            <x-base.tab.panels>

                                <x-base.tab.panel

                                    id="latest-tasks-new"

                                    selected

                                >

                                    <div class="flex items-center">

                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">

                                            <a

                                                class="font-medium"

                                                href=""

                                            >

                                                Create New Campaign

                                            </a>

                                            <div class="text-slate-500">10:00 AM</div>

                                        </div>

                                        <x-base.form-switch class="ml-auto">

                                            <x-base.form-switch.input type="checkbox" />

                                        </x-base.form-switch>

                                    </div>

                                    <div class="mt-5 flex items-center">

                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">

                                            <a

                                                class="font-medium"

                                                href=""

                                            >

                                                Meeting With Client

                                            </a>

                                            <div class="text-slate-500">02:00 PM</div>

                                        </div>

                                        <x-base.form-switch class="ml-auto">

                                            <x-base.form-switch.input type="checkbox" />

                                        </x-base.form-switch>

                                    </div>

                                    <div class="mt-5 flex items-center">

                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">

                                            <a

                                                class="font-medium"

                                                href=""

                                            >

                                                Create New Repository

                                            </a>

                                            <div class="text-slate-500">04:00 PM</div>

                                        </div>

                                        <x-base.form-switch class="ml-auto">

                                            <x-base.form-switch.Input type="checkbox" />

                                        </x-base.form-switch>

                                    </div>

                                </x-base.tab.panel>

                            </x-base.tab.panels>

                        </div>

                    </x-base.tab.group>

                    <!-- END: Latest Tasks -->

                    <!-- BEGIN: General Statistic -->

                    <div class="intro-y box col-span-12">

                        <div

                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">

                            <h2 class="mr-auto text-base font-medium">

                                General Statistics

                            </h2>

                            <x-base.menu class="ml-auto sm:hidden">

                                <x-base.menu.button

                                    class="block h-5 w-5"

                                    href="#"

                                >

                                    <x-base.lucide

                                        class="h-5 w-5 text-slate-500"

                                        icon="MoreHorizontal"

                                    />

                                </x-base.menu.button>

                                <x-base.menu.items class="w-40">

                                    <x-base.menu.item>

                                        <x-base.lucide

                                            class="mr-2 h-4 w-4"

                                            icon="File"

                                        /> Download

                                        XML

                                    </x-base.menu.item>

                                </x-base.menu.items>

                            </x-base.menu>

                            <x-base.button

                                class="hidden sm:flex"

                                variant="outline-secondary"

                            >

                                <x-base.lucide

                                    class="mr-2 h-4 w-4"

                                    icon="File"

                                /> Download XML

                            </x-base.button>

                        </div>

                        <div class="grid grid-cols-1 gap-6 p-5 2xl:grid-cols-7">

                            <div class="2xl:col-span-2">

                                <div class="grid grid-cols-2 gap-6">

                                    <div class="box col-span-2 p-5 dark:bg-darkmode-500 sm:col-span-1 2xl:col-span-2">

                                        <div class="font-medium">Net Worth</div>

                                        <div class="mt-1 flex items-center sm:mt-0">

                                            <div class="mr-4 flex w-20">

                                                USP:

                                                <span class="ml-3 font-medium text-success">

                                                    +23%

                                                </span>

                                            </div>

                                            <div class="w-5/6 overflow-auto">

                                                <x-simple-line-chart height="h-[51px]" />

                                            </div>

                                        </div>

                                    </div>

                                    <div class="box col-span-2 p-5 dark:bg-darkmode-500 sm:col-span-1 2xl:col-span-2">

                                        <div class="font-medium">Sales</div>

                                        <div class="mt-1 flex items-center sm:mt-0">

                                            <div class="mr-4 flex w-20">

                                                USP:

                                                <span class="ml-3 font-medium text-danger">

                                                    -5%

                                                </span>

                                            </div>

                                            <div class="w-5/6 overflow-auto">

                                                <x-simple-line-chart height="h-[51px]" />

                                            </div>

                                        </div>

                                    </div>

                                    <div class="box col-span-2 p-5 dark:bg-darkmode-500 sm:col-span-1 2xl:col-span-2">

                                        <div class="font-medium">Profit</div>

                                        <div class="mt-1 flex items-center sm:mt-0">

                                            <div class="mr-4 flex w-20">

                                                USP:

                                                <span class="ml-3 font-medium text-danger">

                                                    -10%

                                                </span>

                                            </div>

                                            <div class="w-5/6 overflow-auto">

                                                <x-simple-line-chart height="h-[51px]" />

                                            </div>

                                        </div>

                                    </div>

                                    <div class="box col-span-2 p-5 dark:bg-darkmode-500 sm:col-span-1 2xl:col-span-2">

                                        <div class="font-medium">Products</div>

                                        <div class="mt-1 flex items-center sm:mt-0">

                                            <div class="mr-4 flex w-20">

                                                USP:

                                                <span class="ml-3 font-medium text-success">

                                                    +55%

                                                </span>

                                            </div>

                                            <div class="w-5/6 overflow-auto">

                                                <x-simple-line-chart height="h-[51px]" />

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="w-full 2xl:col-span-5">

                                <div class="mt-8 flex justify-center">

                                    <div class="mr-5 flex items-center">

                                        <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>

                                        <span>Product Profit</span>

                                    </div>

                                    <div class="flex items-center">

                                        <div class="mr-3 h-2 w-2 rounded-full bg-slate-300"></div>

                                        <span>Author Sales</span>

                                    </div>

                                </div>

                                <div class="mt-8">

                                    <x-stacked-bar-chart-1 height="h-[420px]" />

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- END: General Statistic -->

                </div>

            </x-base.tab.panel>

        </x-base.tab.panels> --}}

    </x-base.tab.group>

    @php

$loctechnicount =DB::table('attendances')->where('check_status','In')->where('technician_id',$tid)->count();

$loctechnician =DB::table('track_locations')->where('technician_id',$tid)->orderby('id','DESC')->first();

if($loctechnicount > 0)
{
    $latitude = $loctechnician->latitude;
    $longitude = $loctechnician->longitude;
    $gpsaddress = $loctechnician->address;
}
else
{
    $latitude = '0.0';
    $longitude = '0.0';
    $gpsaddress = '0.0';
}

@endphp



    <div class="grid grid-cols-12 mt-5">
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
        <div id="map-canvas" style="width: 100%; display: inline-block; height: 300px; border-radius: 6px;">
        </div>
        </div>
    </div>
    
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">

            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px] content-table">

                <x-base.table.thead class='text-center'>

                    <x-base.table.tr>

                        <x-base.table.th class="border-b-0 whitespace-nowrap text-center">

                            Number

                        </x-base.table.th>
                        
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                           Technician

                        </x-base.table.th>

                        <x-base.table.th class="border-b-0 whitespace-nowrap text-center">

                            Customer Name

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Complaint Number

                        </x-base.table.th>

                        <!-- <x-base.table.th class="border-b-0 whitespace-nowrap">

                            Product

                        </x-base.table.th> -->

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            job_category

                        </x-base.table.th>


                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Helper

                        </x-base.table.th>

                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Status

                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Repeat

                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">

                            Complaint Date

                        </x-base.table.th>

                        {{-- <x-base.table.th class=" border-b-0 whitespace-nowrap">

                            Action

                        </x-base.table.th> --}}



                    </x-base.table.tr>

                </x-base.table.thead>

                <x-base.table.tbody >

                    @php

                         $jobs = DB::table('jobs')->where('technician_id',$technician->id)->get();

                                        // print_r($jobs);

                                        // exit;

                    @endphp
                    @php $i = 0; @endphp
                        @foreach ($jobs as $row)

    

                         @php
                         $i ++;
                         $customercount = DB::table('customer_details')

                                        ->where('id', $row->address)

                                        ->count();

                                        // print_r($jobs);

                                        // exit;


                        @endphp



                        <x-base.table.tr class="intro-x text-center">

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                               {{ $i  }}

                            </x-base.table.td>

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                            @if ($row->technician_id != '0')

                                @php

                                    $technicians = DB::table('technicians')->where('id', $row->technician_id)->first();

                                    if ($technicians !== null) {

                                        echo " $technicians->name ";

                                    }

                                @endphp

                                @endif


                            </x-base.table.td>

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                            @if ($row->customer_id != '0')

                                    @php
                                    $users = DB::table('users')->where('id',$row->customer_id)->first();

                                        if ($users !== null) {

                                            echo " $users->name ";

                                        }

                                    @endphp

                                    @endif

                              

                            </x-base.table.td>

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                              <a href='{{ route('job.invoice',$row->id) }}' target='_BLANK'>{{ $row->job_ref_no }}</a>

                            </x-base.table.td>

                            <!-- <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                               {{ $row->product }}

                            </x-base.table.td> -->

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                               {{ $row->job_category }}

                            </x-base.table.td>

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >


                                    @if ($row->helper_id != '0')

                                    @php

                                        $helper = DB::table('helper')->where('id', $row->helper_id)->first();

                                        if ($helper !== null) {

                                            echo "$helper->name";

                                        }

                                    @endphp

                                    @endif

                                </x-base.table.td>

                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >



                               <div class="flex items-center justify-center text-warning">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square stroke-1.5 mr-2 h-4 w-4"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>

                                {{ $row->status }}
                            </div>
                            @if ($row->status == 'Complete')
                                {{ date('d-m-Y', strtotime($row->updated_at)) }}
                            @endif

                            </x-base.table.td>
                            @php
                                $complaintRepeat = DB::table('complaints')->where('id',$row->complaint_id)->first();
                            @endphp
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >
                                {{ $complaintRepeat->repeat_status ?? "N/A" }}

                            </x-base.table.td>
                            
                            <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                {{ date('d-m-Y', strtotime($row->created_at)) }}

                            </x-base.table.td>
                            {{-- <x-base.table.td  class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600" >

                                <a

                                                    class="flex items-center text-success"

                                                    href="{{ route('job.assign_technician',['id'=>$row->id]) }}"

                                                >

                                                <x-base.lucide

                                                        class="mr-1 h-4 w-4"

                                                        icon="CheckSquare"

                                                    />

                                                    Assign Job

                                                </a>

                             </x-base.table.td> --}}



                        </x-base.table.tr>

                        @endforeach

                </x-base.table.tbody>

            </x-base.table>

        </div>
    </div>
@endsection

@push('script')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBc-IV1LhwxzZkVbGfqiHKq-wiHayqgU8&sensor=true" type="text/javascript"></script>
 
 <script type="text/javascript">
function initialize() 
{
 // put latitude and longitude data here
  var latinfo = new google.maps.LatLng(@php echo $latitude; @endphp,@php echo $longitude; @endphp);
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
     center: latinfo,
     zoom: 13
   });
   var marker = new google.maps.Marker({
     map: map,
     position: latinfo,
     draggable: false,
     animation: google.maps.Animation.BOUNCE,
     anchorPoint: new google.maps.Point(0, -29)
  });
   var infowindow = new google.maps.InfoWindow();   
   google.maps.event.addListener(marker, 'click', function() 
   {
     var iwContent = '<div id="pop_window">' + '<div><b>Location</b> : @php echo $gpsaddress; @endphp/div></div>';
     // put content to the infowindow
     infowindow.setContent(iwContent);
     // show infowindow in the google map and at the current marker location
     infowindow.open(map, marker);
   });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endpush