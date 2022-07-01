<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false,'reset' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/attendance-reports',[AttendanceController::class,'getAttendanceReports'])->name('member.reports');
Route::post('/attendance-reports',[AttendanceController::class,'storeAttendenceReport'])->name('member.report');
Route::get('/attendance-report/date',[AttendanceController::class,'getAttendanceReportsByDate'])->name('member.report.date');

Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware'=>['auth','is_admin']],function(){
    Route::get('home', [AdminController::class, 'index'])->name('home');
    Route::get('users', [UserManagementController::class, 'getMemberList'])->name('users.list');
    Route::post('add/user', [UserManagementController::class, 'addMember'])->name('users.add');
    Route::put('edit/user/{user}', [UserManagementController::class, 'updateMember'])->name('users.edit');
    Route::delete('delete/user/{user}', [UserManagementController::class, 'deleteMember'])->name('users.delete');
});
