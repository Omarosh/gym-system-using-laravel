<?php

use App\Http\Controllers\Attended_sessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityMangerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\Api\TraineeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Api\TrainingPackageController;
use App\Http\Controllers\Api\TrainingSessionController;
use App\Http\Controllers\Api\AttendedSessionController;
use App\Models\Trainee;
use App\Models\Trainingpackege;
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
Route::post('/sanctum/token',[TraineeController::class,'login']); 
Route::post('/edit',[TraineeController::class,'update'])->middleware('auth:sanctum');

Auth::routes(['verify' => true]);

//code to verify the email 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/home');
})->middleware(['auth', 'sanctum'])->name('verification.verify');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/training_packages', [TrainingPackageController::class,'store']);
    Route::get('/trainees/{trainee}', [TraineeController::class,'show']);
    Route::post('/training_sessions', [TrainingSessionController::class,'store']);
    Route::get('/training_sessions/{training_session}', [TrainingSessionController::class,'show']);
    Route::post('training_sessions/{training_session}', [TrainingSessionController::class,'update']);
    Route::get('training_sessions', [TrainingSessionController::class,'index']);    //done
    Route::delete('training_sessions/{training_session}', [TrainingSessionController::class,'destroy']);
    Route::post('/attended_sessions', [AttendedSessionController::class,'store']); //done
    Route::get('/attended_sessions', [AttendedSessionController::class,'index']); //done
    Route::post('/attended_sessions/{attended_session}', [AttendedSessionController::class,'update']);
    Route::delete('/attended_sessions/{attended_session}', [AttendedSessionController::class,'destroy']);
    Route::get('/attended_sessions/{attended_session}', [AttendedSessionController::class,'show']);  //done
    Route::get('/trainees/{trainee}/sessions', [TraineeController::class,'show_trainee_sessions']);  //done
    Route::get('/trainees/{trainee}/history', [TraineeController::class,'show_trainee_history']); //done
});