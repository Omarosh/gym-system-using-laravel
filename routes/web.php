<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CityMangerController;
use App\Http\Controllers\GymController;
use Illuminate\Support\Facades\Route;
use App\Models\CityManger;
use App\Models\GymManger;
use App\Models\Gym;
use App\Models\Coach;



use App\Models\User;



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
//Route::get('/', [CityMangerController::class,'update'])->name("citymanger.store");
//Route::post('/citymanager', [CityMangerController::class,'store'])->name("citymanger.store");
// Route::post('/citymanager',function(){
//     return "lol";
// });

Route::get('/attendance',[AttendanceController::class,'index'])->name('attendance.index');
Route::get('/attendance',[AttendanceController::class,'showView'])->name('attendance.show');

