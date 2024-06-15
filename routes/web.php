<?php

use App\Api\V1\Controllers\TechnicianController;
use App\Http\Controllers\Admin\AMCController;
use App\Http\Controllers\Admin\TechnicianManagementController;
use App\Http\Controllers\Attendance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UsersManagementController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobSubCategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ComplaintReportController;
use App\Http\Controllers\dashBoardController;
use App\Http\Controllers\ComplainReportController;
use App\Http\Controllers\AmcReportController;
use App\Http\Controllers\TechnichianReportController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SupervisorController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    dd('Cache cleared Succesfully');
});







Route::get('/search', [ComplaintController::class, 'search'])->name('search');
Route::get('/search-job/{status}', [JobController::class, 'search_job'])->name('search_job');
Route::get('/search-amc', [AMCController::class, 'search_amc'])->name('search_amc');
Route::get('/search-upcomming', [AMCController::class, 'search_upcomming'])->name('search_upcomming');
Route::get('/search-pending', [AMCController::class, 'search_pending'])->name('search_pending');
Route::get('/search-expire', [AMCController::class, 'search_expire'])->name('search_expire');
Route::get('/search-technician', [TechnicianManagementController::class, 'search_technician'])->name('search_technician');
Route::get('/search-helper', [HelperController::class, 'search_helper'])->name('search_helper');

Route::get('job-invoice/{id}', [JobController::class, 'job_invoice'])->name('job.job-invoice');

Route::post('job/destroy/{id}', [JobController::class, 'jobDelete'])->name('job.destroy');
// Route::get('job/xyz',[JobController::class,'xyz']);
// Helper Section
Route::get('helper',[HelperController::class,'helper'])->name('helper');
Route::post('create_helper/store', [HelperController::class, 'add'])->name('helper.add');
Route::get('create_helper', [HelperController::class, 'create'])->name('create.helper');
Route::get('helper-edit-profile/{id}', [HelperController::class, 'editProfile'])->name('helper.edit.profile');
Route::post('helper-update-profile', [HelperController::class, 'updateProfile'])->name('helper.update.profile');

#Supervisor
Route::get('supervisor',[SupervisorController::class,'index'])->name('supervisor.index');
Route::get('supervisor/create',[SupervisorController::class,'create'])->name('supervisor.create');
Route::post('supervisor/store',[SupervisorController::class,'store'])->name('supervisor.store');
Route::get('supervisor/edit/{id}',[SupervisorController::class,'edit'])->name('supervisor.edit');
Route::post('supervisor/update/{id}',[SupervisorController::class,'update'])->name('supervisor.update');


Route::get('amcreport',[AmcReportController::class,'amcreport'])->name('amcreport');
Route::get('amcreport-view/{id}', [AmcReportController::class, 'ViewReport'])->name('ViewReport');
Route::post('amc_filter', [AmcReportController::class, 'amc_filter'])->name('create.report.form.amcfilter');
Route::post('amcreset', [AmcReportController::class, 'amc_sample_reset'])->name('create.report.form.amcresetfilter');
Route::get('technicianreport',[TechnichianReportController::class,'technichianreport'])->name('technicianreport');
Route::post('technicianfilter', [TechnichianReportController::class, 'technician_filter'])->name('create.report.form.technicianfilter');
Route::post('technicianreset', [TechnichianReportController::class, 'texhnician_sample_reset'])->name('create.report.form.technicianresetfilter');
Route::get('complainreport',[ComplainReportController::class,'complainreport'])->name('complainreport');
Route::get('repeat-complaint/{id}',[ComplainReportController::class,'RepeatComplaint'])->name('RepeatComplaint');
Route::get('search/complainreport',[ComplainReportController::class,'search'])->name('complainreport.search');
Route::post('complainfilter', [ComplainReportController::class, 'complain_filter'])->name('create.report.form.complainfilter');
Route::post('reset', [ComplainReportController::class, 'complain_sample_reset'])->name('create.report.form.resetfilter');
Route::get('complainreport/list/{id}',[ComplainReportController::class,'complaintlist'])->name('complainreport.list');
Route::get('complainreport/detail/{id}',[ComplainReportController::class,'complaintdetail'])->name('complainreport.detail');

Route::get('customerreport',[ComplainReportController::class,'customerreport'])->name('customerreport');
Route::get('customerreport/list/{id}',[ComplainReportController::class,'customerreportlist'])->name('customerreport.list');
Route::post('customerfilter', [ComplainReportController::class, 'customer_filter'])->name('create.report.form.customerfilter');
Route::post('customer-reset', [ComplainReportController::class, 'customer_sample_reset'])->name('create.report.form.customerresetfilter');

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function () {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

 Route::controller(dashBoardController::class)->group(function () {
        Route::get('hold_complaines','hold_complaines')->name('hold_complaines');
        Route::get('pending_complaines','pending_complaines')->name('pending_complaines');
        Route::get('complete_complaines','complete_complaines')->name('complete_complaines');
    });


Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('create_user', [UsersManagementController::class, 'create'])->name('user.create');
    Route::post('create_user', [UsersManagementController::class, 'add'])->name('user.add');
    Route::get('edit_user/{id}', [UsersManagementController::class, 'edit'])->name('user.edit');
    Route::post('update_user', [UsersManagementController::class, 'update'])->name('user.update');
   Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
       ],
        'except' => [
            'deleted',
        ],
    ]);


// Route::get('logout', [AuthController::class, 'index'])->name('logout');
Route::get('/technician', 'TechnicianManagementController@index')->name('technician.index');
Route::get('create_technician', [TechnicianManagementController::class, 'create'])->name('create.technician');
Route::post('add_technician', [TechnicianManagementController::class, 'add_technician'])->name('technician.add');
Route::get('technician-profile/{id}', [TechnicianManagementController::class, 'technicianProfile'])->name('technician.profile');
Route::get('technician-profile1/{id}', [TechnicianManagementController::class, 'attendancelist'])->name('technician.profile1');
Route::get('technician-edit-profile/{id}', [TechnicianManagementController::class, 'editProfile'])->name('technician.edit.profile');
Route::get('/technicians', [TechnicianManagementController::class, 'index'])->name('technician.index');
Route::post('update_technician', [TechnicianManagementController::class, 'updateProfile'])->name('technician.update.profile');
    Route::resource('technician', \App\Http\Controllers\Admin\TechnicianManagementController::class, [
        'names' => [
            'index'   => 'technician',
            'destroy' => 'technician.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    // Route::resource('customer', \App\Http\Controllers\UsersManagementController::class, [
    //     'names' => [
    //         'index'   => 'customer',
    //         'destroy' => 'user.destroy',
    //     ],
    //     'except' => [        
    //         'deleted',
    //     ],
    // ]);
    Route::get('customer', [CustomerController::class, 'view'])->name('customer.list');
    Route::get('/search-customer', [CustomerController::class, 'search_customer'])->name('search_customer');
    Route::get('edit_customer/{id}', [CustomerController::class, 'edit_customer'])->name('edit.customer');
    Route::get('del_address', [CustomerController::class, 'del_address_customer'])->name('del.customer.address');
    Route::get('del_customer', [CustomerController::class, 'del_customer'])->name('del.customer');
    Route::get('create_customer', [CustomerController::class, 'create'])->name('create.customer.form');
    Route::get('customer_profile/{id}', [CustomerController::class, 'customer_profile'])->name('customer.profile');
    Route::get('removed-ac', [CustomerController::class, 'removeAC'])->name('removeAC');
    Route::post('update_customer', [CustomerController::class, 'update_customer'])->name('update.customer');
    Route::post('create_custome_add1', [CustomerController::class, 'create_add'])->name('create.customer.form.add1');
    Route::post('delete-address/{id}', [CustomerController::class, 'deleteAddress'])->name('delete-address');
    Route::post('mobile-check', [CustomerController::class, 'checkmobile'])->name('checkmobile');
    Route::post('mobile-check-with-id/{id}', [CustomerController::class, 'checkmobileuserid'])->name('checkmobileuserid');
 



    Route::get('add_amc', [AMCController::class, 'create_add_amc'])->name('add.amc.form');
    Route::get('amc', [AMCController::class, 'list'])->name('list.amc');
    Route::get('add_amc', [AMCController::class, 'create'])->name('create.amc.form');
    Route::get('edit_amc/{id}', [AMCController::class, 'edit_amc'])->name('edit.amc');
    Route::get('upcuming-amc', [AMCController::class, 'upcuming_amc'])->name('upcuming-amc');
    Route::get('panding-amc', [AMCController::class, 'pending_amc'])->name('panding-amc');
    Route::get('expire-amc', [AMCController::class, 'expire_amc'])->name('expire-amc');
    Route::get('end-amc', [AMCController::class, 'end_amc'])->name('end-amc');
    Route::get('expire-amc-form/{id}', [AMCController::class, 'expire_amc_form'])->name('expire.amc.form');
    Route::post('create_custome_add', [AMCController::class, 'create_add'])->name('create.amc.form.add');
    Route::get('del_amc', [AMCController::class, 'del_amc'])->name('del.amc');
    Route::post('update_amc', [AMCController::class, 'update_amc'])->name('update.amc');
    Route::get('del_address', [AMCController::class, 'del_address_amc'])->name('del.amc.address');

    Route::get('create_invoice',[InvoiceController::class,'create_invoice'])->name('create.invoice');
    Route::post('add_invoice', [InvoiceController::class, 'add_invoice'])->name('add.invoice');
    Route::get('list_invoice', [InvoiceController::class, 'list_invoice'])->name('list.invoice');
    Route::get('view_invoice/{id}',[InvoiceController::class,'view_invoice'])->name('view.invoice');
    Route::get('view_pdf/{id}',[InvoiceController::class,'view_pdf'])->name('view.pdf');

    Route::delete('job/destroy/{$id}', [JobController::class, 'delete'])->name('job.destroy');
    Route::get('job-form-create', [JobController::class, 'job_create_form'])->name('job.create.form');
    Route::get('list-job/all', [JobController::class, 'list_job'])->name('list.job');
    Route::get('list-job/processing', [JobController::class, 'processing_list_job'])->name('list.job.processing');
    Route::get('list-job/assign', [JobController::class, 'assign_list_job'])->name('list.job.assign'); 
    Route::get('list-job/pending', [JobController::class, 'pending_list_job'])->name('list.job.pending'); 
    Route::get('categorywise-job/{id}', [JobController::class, 'categorywiseJobList'])->name('categorywiseJobList.list');
    Route::get('assign-technician', [JobController::class, 'assign_technician'])->name('job.assign_technician');
    Route::post('update_assign_technician', [JobController::class, 'update_assign_technician'])->name('job.update.assign_technician');
    Route::post('job-form-post', [JobController::class, 'job_create_add'])->name('job.create.add');
    Route::get('invoice/{id}', [JobController::class, 'invoice'])->name('job.invoice');
    Route::get('assigned_job', [JobController::class, 'assigned_job'])->name('assigned.job');
    Route::get('show/job/{id}', [JobController::class, 'show_job'])->name('show_job.job');
    Route::get('crone-job', [JobController::class, 'crone_job']);
    Route::get('del_notification', [JobController::class, 'del_notification'])->name('del.notification');
    

    

    Route::get('all_in_tech', [Attendance::class, 'get_in_tech'])->name('in.tech');


    Route::get('category', [JobCategoryController::class, 'category'])->name('category');
    Route::get('/search-category', [JobCategoryController::class, 'search_category'])->name('search_category');
    Route::get('add-category', [JobCategoryController::class, 'add_category'])->name('add.category');
    Route::get('edit-category', [JobCategoryController::class, 'edit_category'])->name('edit.category');
    Route::post('edit-category-db', [JobCategoryController::class, 'edit_category_db'])->name('update.category.db');
    Route::get('del-category', [JobCategoryController::class, 'del_category'])->name('del.category');
    Route::post('add-category-db', [JobCategoryController::class, 'add_category_db'])->name('add.category.db');
    
    Route::get('subcategory', [JobSubCategoryController::class, 'subcategory'])->name('subcategory');
    Route::get('/search-subcategory', [JobSubCategoryController::class, 'search_subcategory'])->name('search_subcategory');
    Route::get('add-subcategory', [JobSubCategoryController::class, 'add_subcategory'])->name('add.subcategory');
    Route::get('edit-subcategory/{id}', [JobSubCategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
    Route::post('edit-subcategory-db', [JobSubCategoryController::class, 'edit_subcategory_db'])->name('update.subcategory.db');
    Route::get('del-subcategory', [JobSubCategoryController::class, 'del_subcategory'])->name('del.subcategory');
    Route::post('add-subcategory-db', [JobSubCategoryController::class, 'add_subcategory_db'])->name('add.subcategory.db');

    Route::get('subcategory-status', [JobSubCategoryController::class, 'changeStatus'])->name('subcategory.status');

    

    Route::get('complaint', [ComplaintController::class, 'complaint'])->name('list.complaint');
    Route::get('edit_complaint/{id}', [ComplaintController::class, 'edit_complaint'])->name('edit.complaint');
    Route::post('update_complaint', [ComplaintController::class, 'update_complaint'])->name('update.complaint');
    Route::get('create_complaint', [ComplaintController::class, 'create_complaint'])->name('create.complaint');
    Route::get('del_complaint/{id}', [ComplaintController::class, 'del_complaint'])->name('del.complaint');
    Route::post('get_customer_address', [ComplaintController::class, 'get_customer_address'])->name('get.customer.address');
    Route::post('get_customer_acdetail', [ComplaintController::class, 'get_customer_acdetail'])->name('get.customer.acdetail');
    Route::post('get_customer_mobile', [ComplaintController::class, 'get_customer_mobile'])->name('get.customer.mobile');
    Route::post('get_customer_amc', [ComplaintController::class, 'get_customer_amc'])->name('get.customer.amc');
    Route::post('add_complaint', [ComplaintController::class, 'add_complaint'])->name('add.complaint');


    Route::get('view_product',[ProductController::class,'view_product'])->name('view.product');
    Route::get('/search-product', [ProductController::class, 'search_product'])->name('search_product');
    Route::post('add_product',[ProductController::class,'add_product'])->name('add.product');
    Route::get('product',[ProductController::class,'add_form_product'])->name('form.product');
    Route::get('del_product',[ProductController::class,'del_product'])->name('del.product');
    Route::get('edit_product/{id}',[ProductController::class,'edit_product'])->name('edit.product');
    Route::post('update_product',[ProductController::class,'update_product'])->name('update.product');


    Route::get('view_calendar',[TaskController::class,'view_calendar'])->name('view.calendar');
    // Route::get('calender/dynamic-full-calendar.html',[TaskController::class,'view_calendar'])->name('view.calendar');
    Route::get('get_calendar',[TaskController::class,'get_calendar'])->name('get.calendar');
    Route::post('add_task',[TaskController::class,'add_task'])->name('add.task');
    Route::get('fullcalender', [TaskController::class, 'calender']);


    Route::resource('add-amc', \App\Http\Controllers\AmcManagementController::class, [
        'names' => [
            'index'   => 'add-amc',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('customer-complaints', \App\Http\Controllers\CustomerComplaintsManagementController::class, [
        'names' => [
            'index'   => 'customer-complaints',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    

    Route::controller(PageController::class)->group(function () {
        Route::post('/change-checkin-count', 'changeCheckInCount')->name('change-checkin-count');
        Route::get('/', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic-page', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline-page', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon-page', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block-page', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document-page', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
	Route::get('/export-data', function () {
    return Excel::download(new YourExportClassName(), 'exported-data.xlsx');
});
    });
});

