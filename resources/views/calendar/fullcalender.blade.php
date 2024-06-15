@extends('../layouts/side-menu')

@section('subhead')
    <title>calendar</title>
@endsection

@section('subcontent')
    
    <div class="mt-5 grid grid-cols-12 gap-5 ">
        <!-- BEGIN: Calendar Side Menu -->
        <div class="col-span-12 xl:col-span-4 2xl:col-span-3 ">
          
            <div class="box intro-y mt-5 p-5 hidden">
                <div class="flex">
                    <x-base.lucide
                        class="h-5 w-5 text-slate-500"
                        icon="ChevronLeft"
                    />
                    <div class="mx-auto text-base font-medium">April</div>
                    <x-base.lucide
                        class="h-5 w-5 text-slate-500"
                        icon="ChevronRight"
                    />
                </div>
                <div class="mt-5 grid grid-cols-7 gap-4 text-center">
                    <div class="font-medium">Su</div>
                    <div class="font-medium">Mo</div>
                    <div class="font-medium">Tu</div>
                    <div class="font-medium">We</div>
                    <div class="font-medium">Th</div>
                    <div class="font-medium">Fr</div>
                    <div class="font-medium">Sa</div>
                    <div class="relative rounded py-0.5 text-slate-500">29</div>
                    <div class="relative rounded py-0.5 text-slate-500">30</div>
                    <div class="relative rounded py-0.5 text-slate-500">31</div>
                    <div class="relative rounded py-0.5">1</div>
                    <div class="relative rounded py-0.5">2</div>
                    <div class="relative rounded py-0.5">3</div>
                    <div class="relative rounded py-0.5">4</div>
                    <div class="relative rounded py-0.5">5</div>
                    <div class="relative rounded bg-success/20 py-0.5 dark:bg-success/30">
                        6
                    </div>
                    <div class="relative rounded py-0.5">7</div>
                    <div class="relative rounded bg-primary py-0.5 text-white">
                        8
                    </div>
                    <div class="relative rounded py-0.5">9</div>
                    <div class="relative rounded py-0.5">10</div>
                    <div class="relative rounded py-0.5">11</div>
                    <div class="relative rounded py-0.5">12</div>
                    <div class="relative rounded py-0.5">13</div>
                    <div class="relative rounded py-0.5">14</div>
                    <div class="relative rounded py-0.5">15</div>
                    <div class="relative rounded py-0.5">16</div>
                    <div class="relative rounded py-0.5">17</div>
                    <div class="relative rounded py-0.5">18</div>
                    <div class="relative rounded py-0.5">19</div>
                    <div class="relative rounded py-0.5">20</div>
                    <div class="relative rounded py-0.5">21</div>
                    <div class="relative rounded py-0.5">22</div>
                    <div class="relative rounded bg-pending/20 py-0.5 dark:bg-pending/30">
                        23
                    </div>
                    <div class="relative rounded py-0.5">24</div>
                    <div class="relative rounded py-0.5">25</div>
                    <div class="relative rounded py-0.5">26</div>
                    <div class="relative rounded bg-primary/10 py-0.5 dark:bg-primary/50">
                        27
                    </div>
                    <div class="relative rounded py-0.5">28</div>
                    <div class="relative rounded py-0.5">29</div>
                    <div class="relative rounded py-0.5">30</div>
                    <div class="relative rounded py-0.5 text-slate-500">1</div>
                    <div class="relative rounded py-0.5 text-slate-500">2</div>
                    <div class="relative rounded py-0.5 text-slate-500">3</div>
                    <div class="relative rounded py-0.5 text-slate-500">4</div>
                    <div class="relative rounded py-0.5 text-slate-500">5</div>
                    <div class="relative rounded py-0.5 text-slate-500">6</div>
                    <div class="relative rounded py-0.5 text-slate-500">7</div>
                    <div class="relative rounded py-0.5 text-slate-500">8</div>
                    <div class="relative rounded py-0.5 text-slate-500">9</div>
                </div>
                <div class="mt-5 border-t border-slate-200/60 pt-5 dark:border-darkmode-400">
                    <div class="flex items-center">
                        <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>
                        <span class="truncate">Independence Day</span>
                        <div class="mx-3 h-px flex-1 border border-r border-dashed border-slate-200 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">23th</span>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>
                        <span class="truncate">Memorial Day</span>
                        <div class="mx-3 h-px flex-1 border border-r border-dashed border-slate-200 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">10th</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Calendar Side Menu -->

        <!-- BEGIN: Calendar Content -->
        <div class="col-span-12 xl:col-span-12 2xl:col-span-12">
            <div class="box p-5">
            <?php include app_path() . '/calender/dynamic-full-calendar.html'; ?>
            </div>
        </div>
        <!-- END: Calendar Content -->
    </div>

@endsection
