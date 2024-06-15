<?php



use App\Api\V1\Controllers\AuthController;

use App\Api\V1\Controllers\TechnicianController;

use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Api\V1\Controllers', 'prefix' => 'v1'], function () {



    /* LRF */

    Route::post('login', [AuthController::class, 'login'])->name('login');



    /* With Authentication APIs */

    Route::group(['middleware' => ['auth.custom.api']], function () {

        Route::prefix('technician')->as('technician')->group(function () {

             Route::get('my-profile', [TechnicianController::class, 'myProfile']);

             Route::get('job-list', [TechnicianController::class, 'jobList']);

             Route::get('job-details', [TechnicianController::class, 'jobDetails']);
             Route::get('category', [TechnicianController::class, 'Category']);
             Route::get('subcatedgory', [TechnicianController::class, 'Subcategory']);
             Route::post('update-subcatedgory', [TechnicianController::class, 'updateSubcategory']);
             Route::post('received-amount', [TechnicianController::class, 'receivedAmount']);
             Route::get('bill-amount', [TechnicianController::class, 'billAmount']);

             Route::post('job-complete', [TechnicianController::class, 'jobComplete']);

             Route::post('check-in-check-out', [TechnicianController::class, 'changeCheckInCheckOut']);

             Route::post('track-location', [TechnicianController::class, 'tracklocation']);

             Route::post('check-status', [TechnicianController::class, 'checkStatus']);

             Route::post('logout', [TechnicianController::class, 'logOut']);

             Route::get('technician-count', [TechnicianController::class, 'techniciancout']);

	     Route::post('updateStatus', [TechnicianController::class, 'updateStatus']);

	     Route::post('statushold', [TechnicianController::class, 'statushold']);

	     Route::post('statuscomplate', [TechnicianController::class, 'statuscomplate']);

             Route::get('terms', [TechnicianController::class, 'terms']);

	     Route::get('getcategories', [TechnicianController::class, 'getcategories']);

	     Route::post('updateCategory', [TechnicianController::class, 'updateCategory']);
	     
	     Route::post('jobUpdateCategory', [TechnicianController::class, 'jobUpdateCategory']);
	     
	     Route::get('privacyPolicy', [TechnicianController::class, 'privacyPolicy']);
	     
	     Route::get('aboutus', [TechnicianController::class, 'aboutus']);

         Route::post('searchJobs', [TechnicianController::class, 'searchJobs']);


        });



    });

});

