@extends('../layouts/' . $layout)

@section('subhead')
    <title>Transaction List - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <h2 class="mt-10 text-lg font-medium intro-y">Transaction List</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y xl:flex-nowrap">
            <div class="flex w-full sm:w-auto">
                <div class="relative w-48 text-slate-500">
                    <x-base.form-input
                        class="!box w-48 pr-10"
                        type="text"
                        placeholder="Search by invoice..."
                    />
                    <x-base.lucide
                        class="absolute inset-y-0 right-0 w-4 h-4 my-auto mr-3"
                        icon="Search"
                    />
                </div>
                <x-base.form-select class="!box ml-2">
                    <option>Status</option>
                    <option>Waiting Payment</option>
                    <option>Confirmed</option>
                    <option>Packing</option>
                    <option>Delivered</option>
                    <option>Completed</option>
                </x-base.form-select>
            </div>
            <div class="hidden mx-auto text-slate-500 xl:block">
                Showing 1 to 10 of 150 entries
            </div>
            <div class="flex items-center w-full mt-3 xl:mt-0 xl:w-auto">
                <x-base.button
                    class="mr-2 shadow-md"
                    variant="primary"
                >
                    <x-base.lucide
                        class="w-4 h-4 mr-2"
                        icon="FileText"
                    /> Export to
                    Excel
                </x-base.button>
                <x-base.button
                    class="mr-2 shadow-md"
                    variant="primary"
                >
                    <x-base.lucide
                        class="w-4 h-4 mr-2"
                        icon="FileText"
                    /> Export to PDF
                </x-base.button>
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
                                icon="Printer"
                            /> Print
                        </x-base.menu.item>
                        <x-base.menu.item>
                            <x-base.lucide
                                class="w-4 h-4 mr-2"
                                icon="FileText"
                            /> Export to
                            Excel
                        </x-base.menu.item>
                        <x-base.menu.item>
                            <x-base.lucide
                                class="w-4 h-4 mr-2"
                                icon="FileText"
                            /> Export to
                            PDF
                        </x-base.menu.item>
                    </x-base.menu.items>
                </x-base.menu>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="col-span-12 overflow-auto intro-y 2xl:overflow-visible">
            <x-base.table class="-mt-2 border-separate border-spacing-y-[10px]">
                <x-base.table.thead>
                    <x-base.table.tr>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            <x-base.form-check.input type="checkbox" />
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            INVOICE
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            BUYER NAME
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            STATUS
                        </x-base.table.th>
                        <x-base.table.th class="border-b-0 whitespace-nowrap">
                            PAYMENT
                        </x-base.table.th>
                        <x-base.table.th class="text-right border-b-0 whitespace-nowrap">
                            <div class="pr-16">TOTAL TRANSACTION</div>
                        </x-base.table.th>
                        <x-base.table.th class="text-center border-b-0 whitespace-nowrap">
                            ACTIONS
                        </x-base.table.th>
                    </x-base.table.tr>
                </x-base.table.thead>
                <x-base.table.tbody>
                    @foreach (array_slice($fakers, 0, 9) as $faker)
                        <x-base.table.tr class="intro-x">
                            <x-base.table.td
                                class="w-10 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                <x-base.form-check.input type="checkbox" />
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-40 border-b-0 bg-white !py-4 shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                <a
                                    class="underline whitespace-nowrap decoration-dotted"
                                    href=""
                                >
                                    {{ '#INV-' . $faker['totals'][0] . '807556' }}
                                </a>
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-40 border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                <a
                                    class="font-medium whitespace-nowrap"
                                    href=""
                                >
                                    {{ $faker['users'][0]['name'] }}
                                </a>
                                @if ($faker['true_false'][0])
                                    <div
                                        class="mt-0.5 whitespace-nowrap text-xs text-slate-500"
                                        v-if="faker.true_false[0]"
                                    >
                                        Ohio, Ohio
                                    </div>
                                @else
                                    <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                        California, LA
                                    </div>
                                @endif
                            </x-base.table.td>
                            <x-base.table.td
                                class="border-b-0 bg-white text-center shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                <div @class([
                                    'flex items-center justify-center whitespace-nowrap',
                                    'text-success' => $faker['true_false'][0],
                                    'text-danger' => !$faker['true_false'][0],
                                ])>
                                    <x-base.lucide
                                        class="w-4 h-4 mr-2"
                                        icon="CheckSquare"
                                    />
                                    {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                                </div>
                            </x-base.table.td>
                            <x-base.table.td
                                class="border-b-0 bg-white shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                @if ($faker['true_false'][0])
                                    <div class="whitespace-nowrap">
                                        Direct bank transfer
                                    </div>
                                    <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                        25 March, 12:55
                                    </div>
                                @else
                                    <div class="whitespace-nowrap">
                                        Checking payments
                                    </div>
                                    <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                        30 March, 11:00
                                    </div>
                                @endif
                            </x-base.table.td>
                            <x-base.table.td
                                class="w-40 border-b-0 bg-white text-right shadow-[20px_3px_20px_#0000000b] first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600"
                            >
                                <div class="pr-16">${{ $faker['totals'][0] . ',000,00' }}</div>
                            </x-base.table.td>
                            <x-base.table.td
                                class="relative border-b-0 bg-white py-0 shadow-[20px_3px_20px_#0000000b] before:absolute before:inset-y-0 before:left-0 before:my-auto before:block before:h-8 before:w-px before:bg-slate-200 first:rounded-l-md last:rounded-r-md dark:bg-darkmode-600 before:dark:bg-darkmode-400"
                            >
                                <div class="flex items-center justify-center">
                                    <a
                                        class="flex items-center mr-5 whitespace-nowrap text-primary"
                                        href="#"
                                    >
                                        <x-base.lucide
                                            class="w-4 h-4 mr-1"
                                            icon="CheckSquare"
                                        />
                                        View Details
                                    </a>
                                    <a
                                        class="flex items-center whitespace-nowrap text-primary"
                                        data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"
                                        href="#"
                                    >
                                        <x-base.lucide
                                            class="w-4 h-4 mr-1"
                                            icon="ArrowLeftRight"
                                        />
                                        Change Status
                                    </a>
                                </div>
                            </x-base.table.td>
                        </x-base.table.tr>
                    @endforeach
                </x-base.table.tbody>
            </x-base.table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="flex flex-wrap items-center col-span-12 intro-y sm:flex-row sm:flex-nowrap">
            <x-base.pagination class="w-full sm:mr-auto sm:w-auto">
                <x-base.pagination.link>
                    <x-base.lucide
                        class="w-4 h-4"
                        icon="ChevronsLeft"
                    />
                </x-base.pagination.link>
                <x-base.pagination.link>
                    <x-base.lucide
                        class="w-4 h-4"
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
                        class="w-4 h-4"
                        icon="ChevronRight"
                    />
                </x-base.pagination.link>
                <x-base.pagination.link>
                    <x-base.lucide
                        class="w-4 h-4"
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
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <x-base.dialog id="delete-confirmation-modal">
        <x-base.dialog.panel>
            <div class="p-5 text-center">
                <x-base.lucide
                    class="w-16 h-16 mx-auto mt-3 text-danger"
                    icon="XCircle"
                />
                <div class="mt-5 text-3xl">Are you sure?</div>
                <div class="mt-2 text-slate-500">
                    Do you really want to delete these records? <br />
                    This process cannot be undone.
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <x-base.button
                    class="w-24 mr-1"
                    data-tw-dismiss="modal"
                    type="button"
                    variant="outline-secondary"
                >
                    Cancel
                </x-base.button>
                <x-base.button
                    class="w-24"
                    type="button"
                    variant="danger"
                >
                    Delete
                </x-base.button>
            </div>
        </x-base.dialog.panel>
    </x-base.dialog>
    <!-- END: Delete Confirmation Modal -->
@endsection
