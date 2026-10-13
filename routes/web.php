
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return redirect()->route('patients.index');
});

Route::get('/patients', [PatientController::class, 'index'])
    ->name('patients.index');

Route::get('/patients/create', [PatientController::class, 'create'])
    ->name('patients.create');

Route::post('/patients', [PatientController::class, 'store'])
    ->name('patients.store');
        