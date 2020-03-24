<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::prefix('admin')->middleware('auth')->name('admin::')->namespace('Admin')->group(function () {
    Route::get('/home', 'Dashboard\HomeController@index')->name('home');

    // Route for department
    Route::prefix('department')->name('department::')->namespace('Department')->group(function() {
        Route::get('index', 'DepartmentController@index')->name('index');
        Route::get('create', 'DepartmentController@create')->name('create');
        Route::post('store', 'DepartmentController@store')->name('store');
        Route::get('show/{department}', 'DepartmentController@show')->name('show');
        Route::get('edit/{department}', 'DepartmentController@edit')->name('edit');
        Route::put('update/{department}', 'DepartmentController@update')->name('update');
        Route::delete('delete/{department}', 'DepartmentController@destroy')->name('destroy');

        // Route for department facility
        Route::prefix('{department}/facility')->name('facility::')->group(function() {
            Route::get('index', 'DepartmentFacilityController@index')->name('index');
            Route::get('create', 'DepartmentFacilityController@create')->name('create');
            Route::post('store', 'DepartmentFacilityController@store')->name('store');
            Route::get('show/{facility}', 'DepartmentFacilityController@show')->name('show');
            Route::get('edit/{facility}', 'DepartmentFacilityController@edit')->name('edit');
            Route::put('update/{facility}', 'DepartmentFacilityController@update')->name('update');
            Route::delete('delete/{facility}', 'DepartmentFacilityController@destroy')->name('destroy');
        });
    });

    // Route for users
    Route::prefix('users')->name('user::')->namespace('User')->group(function() {
        // Route for doctors management
        Route::prefix('doctor')->name('doctor::')->group(function() {
            Route::get('index', 'DoctorController@index')->name('index');
            Route::get('create', 'DoctorController@create')->name('create');
            Route::post('store', 'DoctorController@store')->name('store');
            Route::get('show/{doctor}', 'DoctorController@show')->name('show');
            Route::get('{user}/edit/{doctor}', 'DoctorController@edit')->name('edit');
            Route::put('{user}/update/{doctor}', 'DoctorController@update')->name('update');
            Route::delete('delete/{doctor}', 'DoctorController@destroy')->name('destroy');
        });

        // Route for nurses management
        Route::prefix('nurse')->name('nurse::')->group(function() {
            Route::get('index', 'NurseController@index')->name('index');
            Route::get('create', 'NurseController@create')->name('create');
            Route::post('store', 'NurseController@store')->name('store');
            Route::get('show/{nurse}', 'NurseController@show')->name('show');
            Route::get('edit/{nurse}', 'NurseController@edit')->name('edit');
            Route::put('update/{nurse}', 'NurseController@update')->name('update');
            Route::delete('delete/{nurse}', 'NurseController@delete')->name('delete');
        });

        // Route for patients management
        Route::prefix('patient')->name('patient::')->group(function() {
            Route::get('index', 'PatientController@index')->name('index');
            Route::get('create', 'PatientController@create')->name('create');
            Route::post('store', 'PatientController@store')->name('store');
            Route::get('show/{patient}', 'PatientController@show')->name('show');
            Route::get('{user}/edit/{patient}', 'PatientController@edit')->name('edit');
            Route::put('{user}/update/{patient}', 'PatientController@update')->name('update');
            Route::delete('delete/{patient}', 'PatientController@destroy')->name('destroy');
        });

        // Route for pharmacist management
        Route::prefix('pharmacist')->name('pharmacist::')->group(function() {
            Route::get('index', 'PharmacistController@index')->name('index');
            Route::get('create', 'PharmacistController@create')->name('create');
            Route::post('store', 'PharmacistController@store')->name('store');
            Route::get('show/{pharmacist}', 'PharmacistController@show')->name('show');
            Route::get('edit/{pharmacist}', 'PharmacistController@edit')->name('edit');
            Route::put('update/{pharmacist}', 'PharmacistController@update')->name('update');
            Route::delete('delete/{pharmacist}', 'PharmacistController@delete')->name('delete');
        });

        // Route for laboratorist management
        Route::prefix('laboratorist')->name('laboratorist::')->group(function() {
            Route::get('index', 'LaboratoristController@index')->name('index');
            Route::get('create', 'LaboratoristController@create')->name('create');
            Route::post('store', 'LaboratoristController@store')->name('store');
            Route::get('show/{laboratorist}', 'LaboratoristController@show')->name('show');
            Route::get('edit/{laboratorist}', 'LaboratoristController@edit')->name('edit');
            Route::put('update/{laboratorist}', 'LaboratoristController@update')->name('update');
            Route::delete('delete/{laboratorist}', 'LaboratoristController@delete')->name('delete');
        });

        // Route for accountants management
        Route::prefix('accountant')->name('accountant::')->group(function() {
            Route::get('index', 'AccountantController@index')->name('index');
            Route::get('create', 'AccountantController@create')->name('create');
            Route::post('store', 'AccountantController@store')->name('store');
            Route::get('show/{accountant}', 'AccountantController@show')->name('show');
            Route::get('edit/{accountant}', 'AccountantController@edit')->name('edit');
            Route::put('update/{accountant}', 'AccountantController@update')->name('update');
            Route::delete('delete/{accountant}', 'AccountantController@delete')->name('delete');
        });

        // Route for receptionist management
        Route::prefix('receptionist')->name('receptionist::')->group(function() {
            Route::get('index', 'ReceptionistController@index')->name('index');
            Route::get('create', 'ReceptionistController@create')->name('create');
            Route::post('store', 'ReceptionistController@store')->name('store');
            Route::get('show/{receptionist}', 'ReceptionistController@show')->name('show');
            Route::get('edit/{receptionist}', 'ReceptionistController@edit')->name('edit');
            Route::put('update/{receptionist}', 'ReceptionistController@update')->name('update');
            Route::delete('delete/{receptionist}', 'ReceptionistController@delete')->name('delete');
        });
    });

    // Route for payment/invoice
    Route::prefix('invoice')->name('invoice::')->namespace('Payment')->group(function() {
        Route::get('index', 'InvoiceController@index')->name('index');
        Route::get('create', 'InvoiceController@create')->name('create');
        Route::post('store', 'InvoiceController@store')->name('store');
        Route::get('show/{invoice}', 'InvoiceController@show')->name('show');
        Route::get('edit/{invoice}', 'InvoiceController@edit')->name('edit');
        Route::put('update/{invoice}', 'InvoiceController@update')->name('update');
        Route::delete('delete/{invoice}', 'InvoiceController@delete')->name('delete');
    });

    // Route for beds
    Route::prefix('bed')->name('bed::')->namespace('Bed')->group(function() {
        Route::get('index', 'BedController@index')->name('index');
        Route::get('create', 'BedController@create')->name('create');
        Route::post('store', 'BedController@store')->name('store');
        Route::get('show/{bed}', 'BedController@show')->name('show');
        Route::get('edit/{bed}', 'BedController@edit')->name('edit');
        Route::put('update/{bed}', 'BedController@update')->name('update');
        Route::delete('delete/{bed}', 'BedController@delete')->name('delete');

        // Route for bed allotments
        Route::prefix('allotment')->name('allotment::')->group(function() {
            Route::get('index', 'BedAllotmentController@index')->name('index');
            Route::get('create', 'BedAllotmentController@create')->name('create');
            Route::post('store', 'BedAllotmentController@store')->name('store');
            Route::get('show/{allotment}', 'BedAllotmentController@show')->name('show');
            Route::get('edit/{allotment}', 'BedAllotmentController@edit')->name('edit');
            Route::put('update/{allotment}', 'BedAllotmentController@update')->name('update');
            Route::delete('delete/{allotment}', 'BedAllotmentController@delete')->name('delete');
        });
    });

    // Route for blood
    Route::prefix('blood')->name('blood::')->namespace('Blood')->group(function() {
        // Route for blood bank
        Route::prefix('bank')->name('bank::')->group(function() {
            Route::get('index', 'BloodBankController@index')->name('index');
            Route::get('create', 'BloodBankController@create')->name('create');
            Route::post('store', 'BloodBankController@store')->name('store');
            Route::get('show/{bank}', 'BloodBankController@show')->name('show');
            Route::get('edit/{bank}', 'BloodBankController@edit')->name('edit');
            Route::put('update/{bank}', 'BloodBankController@update')->name('update');
            Route::delete('delete/{bank}', 'BloodBankController@delete')->name('delete');
        });

        // Route for blood donor
        Route::prefix('donor')->name('donor::')->group(function() {
            Route::get('index', 'BloodDonorController@index')->name('index');
            Route::get('create', 'BloodDonorController@create')->name('create');
            Route::post('store', 'BloodDonorController@store')->name('store');
            Route::get('show/{donor}', 'BloodDonorController@show')->name('show');
            Route::get('edit/{donor}', 'BloodDonorController@edit')->name('edit');
            Route::put('update/{donor}', 'BloodDonorController@update')->name('update');
            Route::delete('delete/{donor}', 'BloodDonorController@delete')->name('delete');
        });
    });

    // Route for medicines
    Route::prefix('medicine')->name('medicine::')->namespace('Medicine')->group(function() {
        Route::get('index', 'MedicineController@index')->name('index');
        Route::get('create', 'MedicineController@create')->name('create');
        Route::post('store', 'MedicineController@store')->name('store');
        Route::get('show/{medicine}', 'MedicineController@show')->name('show');
        Route::get('edit/{medicine}', 'MedicineController@edit')->name('edit');
        Route::put('update/{medicine}', 'MedicineController@update')->name('update');
        Route::delete('delete/{medicine}', 'MedicineController@delete')->name('delete');

        // Route for medicine sales
        Route::prefix('sale')->name('sale::')->group(function() {
            Route::get('index', 'MedicineSaleController@index')->name('index');
            Route::get('create', 'MedicineSaleController@create')->name('create');
            Route::post('store', 'MedicineSaleController@store')->name('store');
            Route::get('show/{sale}', 'MedicineSaleController@show')->name('show');
            Route::get('edit/{sale}', 'MedicineSaleController@edit')->name('edit');
            Route::put('update/{sale}', 'MedicineSaleController@update')->name('update');
            Route::delete('delete/{sale}', 'MedicineSaleController@delete')->name('delete');
        });
    });

    // Route for report
    Route::prefix('report')->name('report::')->namespace('Report')->group(function() {
        // Route for operation report
        Route::prefix('operation')->name('operation::')->group(function() {
            Route::get('index', 'OperationController@index')->name('index');
            Route::get('create', 'OperationController@create')->name('create');
            Route::post('store', 'OperationController@store')->name('store');
            Route::get('show/{operation}', 'OperationController@show')->name('show');
            Route::get('edit/{operation}', 'OperationController@edit')->name('edit');
            Route::put('update/{operation}', 'OperationController@update')->name('update');
            Route::delete('delete/{operation}', 'OperationController@delete')->name('delete');
        });

        // Route for birth report
        Route::prefix('birth')->name('birth::')->group(function() {
            Route::get('index', 'BirthController@index')->name('index');
            Route::get('create', 'BirthController@create')->name('create');
            Route::post('store', 'BirthController@store')->name('store');
            Route::get('show/{birth}', 'BirthController@show')->name('show');
            Route::get('edit/{birth}', 'BirthController@edit')->name('edit');
            Route::put('update/{birth}', 'BirthController@update')->name('update');
            Route::delete('delete/{birth}', 'BirthController@delete')->name('delete');
        });

        // Route for death report
        Route::prefix('death')->name('death::')->group(function() {
            Route::get('index', 'DeathController@index')->name('index');
            Route::get('create', 'DeathController@create')->name('create');
            Route::post('store', 'DeathController@store')->name('store');
            Route::get('show/{death}', 'DeathController@show')->name('show');
            Route::get('edit/{death}', 'DeathController@edit')->name('edit');
            Route::put('update/{death}', 'DeathController@update')->name('update');
            Route::delete('delete/{death}', 'DeathController@delete')->name('delete');
        });
    });

    // Route for setting
    Route::prefix('setting')->name('setting::')->namespace('setting')->group(function() {
        // Route for system setting
        Route::prefix('system')->name('system::')->group(function() {
            Route::get('edit', 'SettingController@editSystemSetting')->name('edit');
            Route::put('update', 'SettingController@updateSystemSetting')->name('update');
        });

        // Route for sms setting
        Route::prefix('sms')->name('sms::')->group(function() {
            Route::get('edit', 'SettingController@editSmsSetting')->name('edit');
            Route::put('update', 'SettingController@updateSmsSetting')->name('update');
        });
    });
});

