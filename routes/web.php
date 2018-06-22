<?php

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




Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/free/{date}/{doctor}', 'AppointmentController@freeHours')->name('appointment.free');

    Route::group(['middleware' => ['role.admin']], function() {
        Route::get('/admin', 'AdminController@home')->name('admin.home');
        Route::post('/admin/doctor', 'AdminController@addDoctor')->name('admin.doctor');
        Route::post('/admin/receptionist', 'AdminController@addReceptionist')->name('admin.receptionist');
        Route::get('/admin/list', 'AdminController@list')->name('admin.list');
        Route::delete('/admin/{user}', 'AdminController@destroy')->name('admin.destroy');
    });

    Route::group(['middleware' => ['role.patient']], function() {
        Route::get('/patient', 'PatientController@home');
        Route::get('/patients/profile', 'PatientController@profile')->name('patient.profile');
        Route::put('/patients/{user}', 'PatientController@update')->name('patient.update')->where('user', '[0-9]+');
        Route::get('/patient/appointments', 'PatientController@appointments')->name('patient.appointments');

    });

    Route::group(['middleware' => ['role.receptionist']], function() {
        Route::get('/receptionist', 'ReceptionistController@index');
        Route::get('/appointments/confirmed', 'AppointmentController@confirmed')->name('appointment.confirmed');
        Route::get('/appointments/unconfirmed', 'AppointmentController@unconfirmed')->name('appointment.unconfirmed');

        Route::get('/appointments/{appointment}/remind', 'AppointmentController@remind')->name('appointment.remind')->where('appointment', '[0-9]+');
        Route::post('/appointments/search', 'AppointmentController@search')->name('appointment.search');
        Route::put('/appointments/{appointment}/confirm', 'AppointmentController@confirm')->name('appointment.confirm')->where('appointment', '[0-9]+');

        Route::post('/receptionist/appointment', 'ReceptionistController@addAppointment')->name('receptionist.appointment');
        Route::post('/receptionist/patient', 'ReceptionistController@addPatient')->name('receptionist.patient');
        Route::get('/receptionist/search', 'ReceptionistController@search')->name('receptionist.search');

        Route::get('/patients/{user}', 'PatientController@show')->name('patient.show')->where('user', '[0-9]+');
        Route::get('/patients', 'PatientController@index')->name('patient.index');

        Route::get('/patients/{id}/history', 'PatientController@history')->name('patient.history');

        Route::get('calendar', 'AppointmentController@calendar')->name('calendar');
    });

    Route::group(['middleware' => ['role.doctor']], function() {
        Route::get('/doctor', 'DoctorController@home')->name('doctor.home');

        Route::post('/appointments/{appointment}/consultation', 'ConsultationController@store')->name('consultation.store');
        Route::put('/consultations/{consultation}', 'ConsultationController@update')->name('consultation.update');

        Route::post('/appointments/{appointment}/treatment', 'TreatmentController@attach')->name('appointment.treatment.attach');
        Route::delete('/appointments/{appointment}/treatment/{treatment}', 'TreatmentController@detach')->name('appointment.treatment.detach');
    });


    Route::delete('/appointments/{appointment}', 'AppointmentController@destroy')->name('appointment.destroy')->where('appointment', '[0-9]+');
    Route::get('/appointments/{appointment}/edit', 'AppointmentController@edit')->name('appointment.edit')->where('appointment', '[0-9]+');
    Route::get('/appointments/{appointment}', 'AppointmentController@show')->name('appointment.show')->where('appointment', '[0-9]+');
    Route::put('/appointments/{appointment}', 'AppointmentController@update')->name('appointment.update')->where('appointment', '[0-9]+');
    Route::post('/appointments', 'AppointmentController@store')->name('appointment.store');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');



Route::get('/sendemail2', function () {

$email = new \App\Mail\SendgirdMail(['name' => 'yassine', 'date' => 'today', 'email' => 'benabbou.yassine2@gmail.com']);
$email->send();

return "done";

});



