@extends('../layouts/side-menu')



@section('subhead')

    <title>Users</title>

@endsection



@section('subcontent')

    <h2 class="mt-10 text-lg font-medium intro-y">Users Layout</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">

            <!-- <x-base.button

                class="mr-2 shadow-md"

                variant="primary"

            >

                Add New User

            </x-base.button> -->

            <a data-tw-merge href="{{ route('user.create')}}" class="mr-2 shadow-md transition duration-200 border shadow-sm inline-flex items-center justify-center py-2.5 px-0.8 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1 inline-block w-24 mb-2 mr-1 inline-block w-24" style="padding:10px; width:150px;">Add New User</a>

            <x-base.menu>

                <x-base.menu.button

                    class="!box px-2"

                    as="x-base.button"

                >

                    <span class="flex items-center justify-center w-5 h-5">

                        <x-base.lucide

                            class="w-4 h-4"

                            icon="Plus"

                        />

                    </span>

                </x-base.menu.button>

                <x-base.menu.items class="w-40">

                    <x-base.menu.item>

                        <x-base.lucide

                            class="w-4 h-4 mr-2"

                            icon="Users"

                        /> Add Group

                    </x-base.menu.item>

                    <x-base.menu.item>

                        <x-base.lucide

                            class="w-4 h-4 mr-2"

                            icon="MessageCircle"

                        /> Send

                        Message

                    </x-base.menu.item>

                </x-base.menu.items>

            </x-base.menu>

            <div class="w-full mt-3 sm:mt-0 sm:ml-auto sm:w-auto md:ml-0">

                <div class="relative w-56 text-slate-500">

                    <x-base.form-input

                        class="!box w-56 pr-10"

                        type="text"

                        placeholder="Search..."

                    />

                    <x-base.lucide

                        class="absolute inset-y-0 right-0 w-4 h-4 my-auto mr-3"

                        icon="Search"

                    />

                </div>

            </div>

        </div>

        <!-- BEGIN: Users Layout -->

        @php

        use App\Models\User;

        $Get_User=User::where('type','1')->get();

        // print_r($Get_User);

        // exit;

    @endphp

    @foreach ($Get_User as $data)

        <div class="col-span-12 intro-y md:col-span-6">

            <div class="box">

                <div

                    class="flex flex-col items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400 lg:flex-row">

                    <div class="w-24 h-24 image-fit lg:mr-1 lg:h-12 lg:w-12">

                        <img

                            class="rounded-full"

                            src="https://fastly.picsum.photos/id/548/536/354.jpg?hmac=qL2PIA_0CTKlOdmLWdeM-fnQ7RDbSEMTknPlBdUtW0U"

                            alt="Midone Tailwind HTML Admin Template"

                        />

                    </div>

                    <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">

                        <a

                            class="font-medium"

                            href="{{ route('user.edit',$data->id) }}"

                        >

                            {{ $data->name }}

                        </a>

                        <div class="mt-0.5 text-xs text-slate-500">

                            {{ $data->email }}

                        </div>

                        <div class="mt-0.5 text-xs text-slate-500">

                            {{ $data->phone_no }}

                        </div>

                        <div class="mt-0.5 text-xs text-slate-500">

                            {{ $data->username }}

                        </div>

                    </div>



                </div>

                <div class="flex flex-wrap items-center justify-center p-5 lg:flex-nowrap">

                    <div class="w-full mb-4 mr-auto lg:mb-0 lg:w-1/2">



                    </div>



                    <x-base.button

                        class="px-2 py-1"

                        variant="outline-secondary"

                    >

                        Profile

                    </x-base.button>

                </div>

            </div>

        </div>

    @endforeach



        <!-- END: Users Layout -->

        <!-- BEGIN: Pagination -->

        <!-- END: Pagination -->

    </div>

@endsection

