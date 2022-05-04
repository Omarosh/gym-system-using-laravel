<?php

use App\Http\Controllers\CityMangerController;
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
    dd($coach->gym->city_name);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/gym_managers', [App\Http\Controllers\CityManagerController3::class, 'index'])->name('gym_managers');
// Route::get('/gym_managers/list', [App\Http\Controllers\CityManagerController3::class, 'getCityManagers'])->name('gym_managers.list');


Route::get('/city_managers', [App\Http\Controllers\CityManagerController3::class, 'index'])->name('city_managers');
Route::get('/city_managers/list', [App\Http\Controllers\CityManagerController3::class, 'getCityManagers'])->name('city_managers.list');

Route::put('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController3::class, 'update'])->name('city_manager.update');
Route::delete('/city_manager/{city_manager}', [App\Http\Controllers\CityManagerController3::class, 'destroy'])->name('city_manager.delete');

Auth::routes();
