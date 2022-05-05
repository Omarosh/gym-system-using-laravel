<?php

use App\Http\Controllers\CityManagerController;
use App\Http\Controllers\Auth\cityManagerRegisterController;
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

Route::get('/', function () {
    $coach= Coach::find(1);

    //$GYM->gymManger->name;
   // dd($coach->gym->city_name);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/gym_managers', [App\Http\Controllers\CityManagerController::class, 'index'])->name('gym_managers');
// Route::get('/gym_managers/list', [App\Http\Controllers\CityManagerController3::class, 'getCityManagers'])->name('gym_managers.list');

// City Manager Routes
Route::get('/city_managers', [App\Http\Controllers\CityManagerController::class, 'index'])->name('city_managers');
Route::get('/city_managers/list', [App\Http\Controllers\CityManagerController::class, 'getCityManagers'])->name('city_managers.list');
Route::get('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController::class, 'edit'])->name('city_manager.edit');
Route::put('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController::class, 'update'])->name('city_manager.update');
Route::post('/city_manager/store', [App\Http\Controllers\CityManagerController::class, 'store'])->name('city_manager.store');
Route::get('/create_city_manager', [App\Http\Controllers\CityManagerController::class, 'create'])->name('city_managers.create');

// Packages Routes
Route::get('/create_package', [App\Http\Controllers\TrainingPackagesController::class, 'create'])->name('package.create');
Route::post('/package/store', [App\Http\Controllers\TrainingPackagesController::class, 'store'])->name('package.store');


// Gym Routes
Route::get('/create_gym', [App\Http\Controllers\GymController::class, 'create'])->name('gyms.create');
Route::post('/gym/store', [App\Http\Controllers\GymController::class, 'store'])->name('gyms.store');






Route::post('/city_manager/delete', [CityManagerController::class, 'destroy'])->name('city_manager.delete');

Route::get('/trainees', [App\Http\Controllers\TraineeController::class, 'index'])->name('trainees');
Route::get('/trainees/list', [App\Http\Controllers\TraineeController::class, 'getTrainees'])->name('trainees.list');
Route::get('/trainees/{trainee}', [App\Http\Controllers\TraineeController::class, 'edit'])->name('trainee.edit');
Route::put('/trainees/{trainee}', [App\Http\Controllers\TraineeController::class, 'update'])->name('trainee.update');
Route::post('/trainees/delete', [App\Http\Controllers\TraineeController::class, 'destroy'])->name('trainee.delete');

Route::get('/training_packages', [App\Http\Controllers\TrainingPackagesController::class, 'index'])->name('trainingPackages');
Route::get('/training_packages/list', [App\Http\Controllers\TrainingPackagesController::class, 'getTrainingPackages'])->name('trainingPackages.list');
Route::get('/training_packages/{training_package}', [App\Http\Controllers\TrainingPackagesController::class, 'edit'])->name('trainingPackages.edit');
Route::post('/training_packages/delete', [App\Http\Controllers\TrainingPackagesController::class, 'destroy'])->name('trainingPackages.delete');

Route::get('/gyms', [App\Http\Controllers\GymController::class, 'index'])->name('gyms');
Route::get('/gyms/list', [App\Http\Controllers\GymController::class, 'gymDatatables'])->name('gyms.list');
Route::get('/gyms/{training_package}', [App\Http\Controllers\GymController::class, 'edit'])->name('gyms.edit');
Route::post('/gyms/delete', [App\Http\Controllers\GymController::class, 'destroy'])->name('gyms.delete');

Auth::routes();
