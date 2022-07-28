<?php

use App\Mail\TestMail;
use App\Models\Patient;
use App\Models\PatientsFiles;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use robertogallea\LaravelPython\Services\LaravelPython;

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
        $paramedic = User::role('Paramedic')->get()->count();
        return view('dashboard', [
            'users' => $users,
            'patients' => $patients,
            'paramedic' => $paramedic
        ]);
    })->name('dashboard');

    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::resource('roles', \App\Http\Controllers\RolesController::class);
    Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::resource('pfile', \App\Http\Controllers\PatientsFilesController::class);
});

Route::resource('image', \App\Http\Controllers\ImageCompareController::class);

Route::get('users/log/{user}', [\App\Http\Controllers\UsersController::class, 'log'])->name('users.log');

Route::get('mail', [\App\Http\Controllers\MailController::class, 'sendEmail']);

Route::get('modal', function () {
    return view('patients.modal');
});

Route::get('py', function () {
    $service = new LaravelPython();
    $result = $service->run(Storage::path('test.py'), ["test me please"]);
    return $result;
});

Route::get('mail', function () {
    $details = [
        'title' => 'hello',
        'body' => '123456',
    ];

    Mail::to('dyahunter35@gmail.com')->send(new TestMail($details));
});
Route::get('reset/{email}', function ($email) {
    $status = Password::sendResetLink(
        ["email" => $email]
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['message' => __($status)])
        : back()->withErrors(['message' => __($status)]);
})->name('reset_email');
