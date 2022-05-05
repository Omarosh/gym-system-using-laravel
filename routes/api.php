<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityMangerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\TraineeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Models\Trainee;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/citymanager', [CityMangerController::class,'store'])->name("citymanger.store");
Route::post('/gymmanagers',[GymManagerController::class,'store']);
Route::delete('/gymmanagers/{gymmanager}',[GymManagerController::class,'destroy']);
Route::get('/gymmanagers',[GymManagerController::class,'index']);
Route::get('/gymmanagers/{gymmanager}',[GymManagerController::class,'show']);
Route::post('/gymmanagers/{gymmanager}',[GymManagerController::class,'update']);
Route::get('/coaches',[CoachController::class,'index']);
Route::get('/coaches/{coach}',[CoachController::class,'show']);
Route::post('/coaches',[CoachController::class,'store']);
Route::post('/coaches/{coach}',[CoachController::class,'update']);
Route::delete('/coaches/{coach}',[CoachController::class,'destroy']);
//Route::post('/citymanager', [CityMangerController::class,'store'])->name("citymanger.store");
Route::post('/', [GymController::class,'update'])->name("citymanger.store");


Route::post('/signup',[TraineeController::class,'store']);
Route::post('/login',[TraineeController::class,'index']); // to authenticate   ->middleware('auth:sanctum');
Route::post('/edit',[TraineeController::class,'update'])->middleware('auth:sanctum');




Route::post('/sanctum/token',[TraineeController::class,'login']); 
Auth::routes(['verify' => true]);
 

//code to verify the email 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');