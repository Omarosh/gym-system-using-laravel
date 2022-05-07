<?php

use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\Auth\cityManagerRegisterController;
use Illuminate\Support\Facades\Route;
use App\Models\CityManger;
use App\Models\GymManger;
use App\Models\Gym;
use App\Models\Coach;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Controllers\StripeController;

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

Route::get('/', function () {
    return redirect("login");
});



Route::middleware(['auth','banned'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/gym_managers', [App\Http\Controllers\CityManagerController::class, 'index'])->name('gym_managers');
    
    // City Manager Routes
    Route::get('/city_managers', [App\Http\Controllers\CityManagerController::class, 'index'])->name('city_managers');
    Route::get('/city_managers/list', [App\Http\Controllers\CityManagerController::class, 'getCityManagers'])->name('city_managers.list');
    Route::get('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController::class, 'edit'])->name('city_manager.edit');
    Route::put('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController::class, 'update'])->name('city_manager.update');
    Route::post('/city_manager/store', [App\Http\Controllers\CityManagerController::class, 'store'])->name('city_manager.store');
    Route::get('/create_city_manager', [App\Http\Controllers\CityManagerController::class, 'create'])->name('city_managers.create');
    Route::post('/city_manager/view/{city_manager}/', [App\Http\Controllers\CityManagerController::class, 'view'])->name('city_manager.view');
        
    // Gym Routes
    Route::get('/create_gym', [App\Http\Controllers\GymController::class, 'create'])->name('gyms.create');
    Route::post('/gym/store', [App\Http\Controllers\GymController::class, 'store'])->name('gyms.store');
    Route::post('/gym/view/{gym}', [App\Http\Controllers\GymController::class, 'view'])->name('gyms.view');
    Route::post('/city_manager/delete', [CityManagerController::class, 'destroy'])->name('city_manager.delete');
    
    // Gym Manager Routes
    Route::get('/gym_managers', [App\Http\Controllers\GymManagerController::class, 'index'])->name('gym_managers');
    Route::get('/gym_managers/list', [App\Http\Controllers\GymManagerController::class, 'getGymManagers'])->name('gym_managers.list');
    Route::get('/gym_manager/{gym_manager}', [App\Http\Controllers\GymManagerController::class, 'edit'])->name('gym_manager.edit');
    Route::put('/gym_manager/{gym_manager}', [App\Http\Controllers\GymManagerController::class, 'update'])->name('gym_manager.update');
    Route::post('/gym_manager/store', [App\Http\Controllers\GymManagerController::class, 'store'])->name('gym_manager.store');
    Route::get('/create_gym_manager', [App\Http\Controllers\GymManagerController::class, 'create'])->name('gym_manager.create');
    Route::post('/gym_manager/delete', [App\Http\Controllers\GymManagerController::class, 'destroy'])->name('gym_manager.delete');
    Route::post('/gym_manager/status', [App\Http\Controllers\GymManagerController::class, 'status'])->name('gym_manager.status');
    Route::post('/gym_manager/view/{manager}', [App\Http\Controllers\GymManagerController::class, 'view'])->name('gym_manager.view');
    
    // Trainees Routes
    Route::get('/trainees', [App\Http\Controllers\TraineeController::class, 'index'])->name('trainees');
    Route::get('/trainees/list', [App\Http\Controllers\TraineeController::class, 'getTrainees'])->name('trainees.list');
    Route::get('/trainees/{trainee}', [App\Http\Controllers\TraineeController::class, 'edit'])->name('trainee.edit');
    Route::put('/trainees/{trainee}', [App\Http\Controllers\TraineeController::class, 'update'])->name('trainee.update');
    Route::post('/trainees/delete', [App\Http\Controllers\TraineeController::class, 'destroy'])->name('trainee.delete');
    
    // Packages Routes
    Route::get('/create_package', [App\Http\Controllers\TrainingPackagesController::class, 'create'])->name('package.create');
    Route::post('/package/store', [App\Http\Controllers\TrainingPackagesController::class, 'store'])->name('packages.store');
    Route::post('/package/{id}', [App\Http\Controllers\TrainingPackagesController::class, 'update'])->name('packages.update');
    Route::get('/training_packages', [App\Http\Controllers\TrainingPackagesController::class, 'index'])->name('trainingPackages');
    Route::get('/training_packages/list', [App\Http\Controllers\TrainingPackagesController::class, 'getTrainingPackages'])->name('trainingPackages.list');
    Route::get('/training_packages/{training_package}', [App\Http\Controllers\TrainingPackagesController::class, 'edit'])->name('trainingPackages.edit');
    Route::post('/training_packages/delete', [App\Http\Controllers\TrainingPackagesController::class, 'destroy'])->name('trainingPackages.delete');
    
    // gyms Routes
    Route::get('/gyms', [App\Http\Controllers\GymController::class, 'index'])->name('gyms');
    Route::get('/gyms/list', [App\Http\Controllers\GymController::class, 'gymDatatables'])->name('gyms.list');
    Route::post('/gyms/delete', [App\Http\Controllers\GymController::class, 'destroy'])->name('gyms.delete');
    Route::post('/gyms/{training_package}', [App\Http\Controllers\GymController::class, 'edit'])->name('gyms.edit');
    Route::put('/gyms/{training_package}', [App\Http\Controllers\GymController::class, 'update'])->name('gyms.update');
    
    //cities Routes
    Route::get('/cities', [App\Http\Controllers\CitiesController::class, 'index'])->name('cities');
    Route::get('/cities/list', [App\Http\Controllers\CitiesController::class, 'getCities'])->name('cities.list');
    
    //coaches Routes
    Route::get('/coaches', [App\Http\Controllers\CoachController::class, 'index'])->name('coaches');
    Route::get('/coaches/list', [App\Http\Controllers\CoachController::class, 'getCoaches'])->name('coaches.list');
    Route::post('/coach/store', [App\Http\Controllers\CoachController::class, 'store'])->name('coach.store');
    Route::post('/coach/delete', [App\Http\Controllers\CoachController::class, 'destroy'])->name('coach.delete');
    Route::post('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'edit'])->name('coach.edit');
    Route::put('/coach/{coach}', [App\Http\Controllers\CoachController::class, 'update'])->name('coach.update');
    Route::get('/create_coach', [App\Http\Controllers\CoachController::class, 'create'])->name('coach.create');
    Route::post('/coach/view/{coach}/', [App\Http\Controllers\CoachController::class, 'view'])->name('coach.view');
    
    //training sessions Routes
    Route::get('/create_session', [App\Http\Controllers\TrainingSessionController::class, 'create'])->name('session.create');
    Route::post('/session/store', [App\Http\Controllers\TrainingSessionController::class, 'store'])->name('sessions.store');
    Route::post('/session/{id}', [App\Http\Controllers\TrainingSessionController::class, 'update'])->name('session.update');
    Route::get('/training_sessions', [App\Http\Controllers\TrainingSessionController::class, 'index'])->name('trainingSessions');
    Route::get('/training_sessions/list', [App\Http\Controllers\TrainingSessionController::class, 'getTrainingSessions'])->name('trainingSessions.list');
    Route::get('/training_sessions/{training_session}', [App\Http\Controllers\TrainingSessionController::class, 'edit'])->name('trainingSessions.edit');
    Route::post('/training_sessions/delete', [App\Http\Controllers\TrainingSessionController::class, 'destroy'])->name('trainingSessions.delete');

    // Payment Routes
    Route::get('/purchase_operations', [App\Http\Controllers\PurchaseOperationController::class, 'index'])->name('purchase_operations');
    Route::get('/purchase_operations/list', [App\Http\Controllers\PurchaseOperationController::class, 'getDatatables'])->name('purchase_operations.list');
    Route::get('/stripe-payment', [StripeController::class, 'handleGet2'])->name('stripe-payment');
    Route::post('/stripe-payment', [StripeController::class, 'handlePost2'])->name('stripe.payment');
    
    // Attendance Routes
    Route::get('/attendedtable', [App\Http\Controllers\Api\AttendedSessionController::class,'getAttendance'])->name('attendance.list');
    Route::get('/attendedview', [App\Http\Controllers\Api\AttendedSessionController::class,'view'])->name('attendance');
});


// Banned Gym Manager Route
Route::get('/bannedGymManager', function () {
    return view('bannedGymManager');
})->name('bannedGymManager');


// Auth Routes
Auth::routes(['register'=>false]);
