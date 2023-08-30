<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminController;

//reboot system
Route::get("/reboot",function(){
    Artisan::call("config:clear");
    Artisan::call("config:cache");
    Artisan::call("cache:clear");
    Artisan::call("route:clear");
    Artisan::call("view:clear");
    file_put_contents(storage_path("logs/laravel.log"),'');
    return '<center><h1>System Rebooted!</h1></center>';
});

Route::namespace('App\Http\Controllers')->group(function(){

    Route::namespace('Web')->group(function(){

        Route::get('/', 'WebController@index');
        Route::post('student-login-check',          "StudentController@studentLoginCheck");
        Route::post('/save-student',              "WebController@saveStudent");

        Route::middleware('web_auth')->group(function(){
            Route::get('/our-courses',                "WebController@ourCourses");
            Route::get('/our-batches',                "WebController@ourBatches");
            Route::get('my-account',                    "StudentController@myAccount");
            Route::get('my-course/{student_id}',        "StudentController@myCourse");
            Route::post('save-student-course',          "StudentController@saveStudentCourse");
            Route::get('edit-my-profile/{student_id}',  "StudentController@editProfile");
            Route::post('update-profile',               "StudentController@updateProfile");
            Route::get('student-logout',                "StudentController@studentLogout");
        });

        Route::get('/', function () {
            return view("frontend.member_panel");
        });
        
        Route::get('/student-account-signup', function(){
            return view("frontend.student_account_signup");
        });

        // Payment Routes for bKash
        Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
        Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
        Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

    });

});

//backend route
// Route::get('login/admin', [AdminController::class,'adminLoginForm'])->name('admin.login.form');
// Route::post('admin-login', [AdminController::class,'adminLogin'])->name('admin.login');

// Route::group(['middleware'=>'admin'], function(){
//     Route::get('admin/dashboard', [DashboardController::class,'adminDashboard'])->name('admin.dashboard');
//     Route::get('admin/logout', [AdminController::class,'adminLogout'])->name('admin.logout');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




