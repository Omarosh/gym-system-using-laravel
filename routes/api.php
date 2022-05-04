<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityMangerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GymManagerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\TraineeController;
use App\Models\Trainee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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


Route::post('/trainee',[TraineeController::class,'store']);
Route::post('/login',[TraineeController::class,'index'])->middleware('auth:sanctum');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'passwd' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = Trainee::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->passwd, $user->passwd)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});
Auth::routes(['verify' => true]);