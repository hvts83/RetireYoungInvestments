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

//Web
Auth::routes();
Route::get('/register/{code}', 'Auth\RegisterController@referenceRegister');
Route::get('/register/akademy/{code}', 'Auth\RegisterController@AkademyRegister');

//Admin
Route::get('/admin/login', 'Admin\AuthController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@login')->name('admin.login.submit');
Route::post('/admin/logout', 'Admin\AuthController@logout')->name('admin.logout');

Route::get('/', 'LandingController@index');
Route::get('/akademy', 'LandingController@akademy');
Route::get('/contacto', 'LandingController@contacto');
Route::get('/equipo', 'LandingController@equipo');
Route::get('/inversion', 'LandingController@inversion');
Route::get('/privacidad', 'LandingController@privacidad');
Route::get('/terminos', 'LandingController@terminos');
Route::post('/send-mail', 'LandingController@mail');

//Pagina usuario
Route::get('/home', 'Main\DashboardController@index');
Route::get('/profile', 'Main\ProfileController@index');
Route::put('/profile/update', 'Main\ProfileController@update');
Route::post('/profile/upload', 'Main\ProfileController@upload');
Route::get('/settings', 'Main\SettingController@index');
Route::put('/settings/password', 'Main\SettingController@password');
Route::put('/settings/btc', 'Main\SettingController@btc');

Route::get('invest/plans', 'Main\InvestController@plans');
Route::get('invest/payment', 'Main\InvestController@payment');
Route::get('invest/history', 'Main\InvestController@history');
Route::get('invest/history_detail/{id}', 'Main\InvestController@history_detail');

Route::get('withdraw', 'Main\WithdrawController@index');
Route::post('withdraw/plan', 'Main\WithdrawController@plan');
Route::post('withdraw/special', 'Main\WithdrawController@special');
Route::post('withdraw/comision', 'Main\WithdrawController@comision');
Route::post('withdraw/cancel', 'Main\WithdrawController@cancel');

Route::get('referal/index', 'Main\ReferalController@index');
Route::get('referal/tools', 'Main\ReferalController@tools');

Route::get('course/index', 'Main\CourseController@index');
Route::get('course/tools', 'Main\CourseController@tools');
Route::get('course/pay', 'Main\CourseController@pay');
Route::post('course/send', 'Main\CourseController@sendRequest');
Route::get('course/referal', 'Main\CourseController@referal');
Route::get('course/retire', 'Main\CourseController@retire');
Route::post('course/retire', 'Main\CourseController@postRetire');

Route::get('mailbox/compose', 'Main\MailController@getCompose');
Route::post('mailbox/compose', 'Main\MailController@postcompose');

//Pagina de Adminstrador
Route::get('/admin/', 'Admin\DashboardController@index')->name('admin.home');
Route::get('/admin/home', 'Admin\DashboardController@index')->name('admin.home');
Route::get('/admin/profile', 'Admin\ProfileController@index');
Route::put('/admin/profile/update', 'Admin\ProfileController@update');
Route::put('/admin/profile/password', 'Admin\ProfileController@password');
Route::post('/admin/profile/upload', 'Admin\ProfileController@upload');

Route::get('admin/socios', 'Admin\SociosController@index');
Route::get('admin/socios/view/{id}', 'Admin\SociosController@view');
Route::get('admin/socios/create', 'Admin\SociosController@create');
Route::post('admin/socios/store', 'Admin\SociosController@store');
Route::get('admin/socios/{id}/edit', 'Admin\SociosController@edit');
Route::put('admin/socios/{id}', 'Admin\SociosController@update');

Route::get('admin/retire', 'Admin\RetireController@index');
Route::get('admin/retire/view/{id}', 'Admin\RetireController@view');
Route::post('admin/retire/submit/{id}', 'Admin\RetireController@submit');
Route::get('admin/retire/cancel/{id}', 'Admin\RetireController@cancel');
Route::get('admin/retire/comision/{id}', 'Admin\RetireController@comision');
Route::post('admin/retire/submit_comision/{id}', 'Admin\RetireController@submit_comision');
Route::get('admin/retire/cancel_comision/{id}', 'Admin\RetireController@cancel_comision');

Route::Resource('admin/planes', 'Admin\PlanesController');
Route::Resource('admin/promocional', 'Admin\PromocionalController');
Route::Resource('admin/course', 'Admin\CourseController');
Route::get('admin/promocional/{id}/activar', 'Admin\PromocionalController@activar');

Route::get('admin/config', 'Admin\ConfigController@index');
Route::post('admin/config', 'Admin\ConfigController@update');

Route::get('admin/report', 'Admin\ReportController@index');
Route::get('admin/report/activos', 'Admin\ReportController@activos');
Route::get('admin/report/retiro', 'Admin\ReportController@retiro');
Route::get('admin/report/comision', 'Admin\ReportController@comision');

Route::get('admin/user-plans/index', 'Admin\UserPlansController@index');
Route::get('admin/user-plans/view/{id}', 'Admin\UserPlansController@view');
Route::get('admin/user-plans/activate', 'Admin\UserPlansController@getActivate');
Route::post('admin/user-plans/activate', 'Admin\UserPlansController@postActivate');
Route::get('admin/user-plans/request/{id}', 'Admin\UserPlansController@request');
Route::post('admin/user-plans/request', 'Admin\UserPlansController@postRequest');

Route::get('admin/transaction', 'Admin\TransactionController@index');
Route::post('admin/transaction/daily', 'Admin\TransactionController@daily');
Route::post('admin/transaction/monthly', 'Admin\TransactionController@monthly');

Route::get('admin/akademy/index', 'Admin\AkademyController@getActive');
Route::get('admin/akademy/make', 'Admin\AkademyController@make');
Route::post('admin/akademy/send', 'Admin\AkademyController@send');
Route::get('admin/akademy/active/{id}', 'Admin\AkademyController@postActive');
Route::get('admin/akademy/verify/{id}', 'Admin\AkademyController@verify');

Route::get('admin/akademy/transaction', 'Admin\AkademyController@getTransaction');
Route::post('admin/akademy/transaction', 'Admin\AkademyController@postTransaction');

Route::get('admin/akademy/retire', 'Admin\AkademyController@retire');
Route::get('admin/akademy/retire/view/{id}', 'Admin\AkademyController@viewRetire');
Route::post('admin/akademy/retire/{id}', 'Admin\AkademyController@submitRetire');
Route::get('admin/akademy/retire/cancel/{id}', 'Admin\AkademyController@cancelRetire');

Route::get('admin/akademy/referal', 'Admin\AkademyController@getReferal');
Route::post('admin/akademy/referal', 'Admin\AkademyController@postReferal');

// Two Factor Authentication
Route::get('verify_code/{uri}', 'TwoFactorController@showTwoFactorForm')->name('verify_code');
Route::post('verify_code', 'TwoFactorController@verifyTwoFactor');