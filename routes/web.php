<?php

use App\Models\Patient;
use App\Models\PatientsFiles;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return redirect('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/app', function () {
        return view('phone');
    })->name('phone');

    Route::get('/dashboard', function () {
        $users = User::all()->count();
        $patients = Patient::all()->count();

        return view('dashboard',[
            'users'=>$users,
            'patients'=>$patients,
        ]);
    })->name('dashboard');

    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\RolesController::class);
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('pfile', \App\Http\Controllers\PatientsFilesController::class);


});
Route::get('users/log/{user}', [\App\Http\Controllers\UsersController::class,'log'])->name('users.log');

Route::get('mail', [\App\Http\Controllers\MailController::class, 'sendEmail']);

Route::get('modal', function(){
    return view('patients.modal');
});
