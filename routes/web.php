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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| ADMIN dashboard routes
|--------------------------------------------------------------------------
|*/
Route::prefix('admin')->middleware(['role:super admin|admin'])->group(function () {
    Route::get('', 'AdminController@index')->name('admin.index');
    Route::get('updates', 'AdminController@updates')->name('admin.updates');
    Route::get('permissions_list', 'AdminController@permissionsList')->name('admin.permissions.list');
    //Ajax and API
    Route::post('permission_change', 'AdminController@permissionChange')->name('admin.permissions.change');
    Route::get('api/city_list_update', 'AdminController@cityListUpdate')->name('admin.api.city_list');
});

/*
|--------------------------------------------------------------------------
| PORT routes
|--------------------------------------------------------------------------
|*/
Route::prefix('port')->group(function () {
    Route::get('', 'PortController@index')->name('port.index');
    Route::get('show/{id}/{slug?}', 'PortController@show')->name('port.show');
    Route::get('create', 'PortController@create')->name('port.create')->middleware(['permission:create ports']);
    Route::post('store', 'PortController@store')->name('port.store')->middleware(['permission:create ports']);
    Route::get('edit/{id}/{slug?}', 'PortController@edit')->name('port.edit')->middleware(['permission:edit own ports|edit all ports']);
    Route::put('update', 'PortController@update')->name('port.update')->middleware(['permission:edit own ports|edit all ports']);
    Route::delete('destroy/{id}', 'PortController@destroy')->name('port.delete')->middleware('permission:delete own ports|delete all ports');
    Route::get('users', 'PortController@users')->name('port.users')->middleware(['permission:edit own ports|edit all ports']);
    Route::put('port_admins', 'PortController@portAdmins')->name('port.admins.edit')->middleware(['permission:edit own ports|edit all ports']);
    Route::put('port_operators', 'PortController@portOperators')->name('port.operators.edit')->middleware(['permission:edit own ports|edit all ports']);
    Route::post('add_user', 'PortController@addUser')->name('port.user.add')->middleware(['permission:edit own ports|edit all ports'])->middleware(['permission:create users']);
});

/*
|--------------------------------------------------------------------------
| OPERATORS routes
|--------------------------------------------------------------------------
|*/
Route::prefix('operator')->group(function () {
    Route::get('', 'OperatorController@index')->name('operator.index');
    Route::get('show/{id}/{slug?}', 'OperatorController@show')->name('operator.show');
    Route::get('create', 'OperatorController@create')->name('operator.create')->middleware(['permission:create operators']);
    Route::post('store', 'OperatorController@store')->name('operator.store')->middleware(['permission:create operators']);
    Route::get('edit/{id}/{slug?}', 'OperatorController@edit')->name('operator.edit')->middleware(['permission:edit own operators|edit all operators']);
    Route::put('update', 'OperatorController@update')->name('operator.update')->middleware(['permission:edit own operators|edit all operators']);
    Route::delete('destroy/{id}', 'OperatorController@destroy')->name('operator.delete')->middleware('permission:delete own operators|delete all operators');
    Route::get('users', 'OperatorController@users')->name('operator.users')->middleware(['permission:edit own operators|edit all operators']);
    Route::put('operator_admins', 'OperatorController@operatorAdmins')->name('operator.admins.edit')->middleware(['permission:edit own operators|edit all operators']);
    Route::put('operator_operators', 'OperatorController@operatorOperators')->name('operator.operators.edit')->middleware(['permission:edit own operators|edit all operators']);

});

/*
|--------------------------------------------------------------------------
| VESSEL routes
|--------------------------------------------------------------------------
|*/
Route::prefix('vessel')->group(function () {
    Route::get('', 'VesselController@index')->name('vessel.index');
    Route::get('show/{id}/{slug?}', 'VesselController@show')->name('vessel.show');
    Route::get('create', 'VesselController@create')->name('vessel.create')->middleware(['permission:create vessels']);
    Route::post('store', 'VesselController@store')->name('vessel.store')->middleware(['permission:create vessels']);
    Route::get('edit/{id}/{slug?}', 'VesselController@edit')->name('vessel.edit')->middleware(['permission:edit own vessels|edit all vessels']);
    Route::put('update', 'VesselController@update')->name('vessel.update')->middleware(['permission:edit own vessels|edit all vessels']);
    Route::delete('destroy/{id}', 'VesselController@destroy')->name('vessel.delete')->middleware('permission:delete own vessels|delete all vessels');
    Route::get('users', 'VesselController@users')->name('vessel.users')->middleware(['permission:edit own vessels|edit all vessels']);
    Route::put('vessel_admins', 'VesselController@vesselAdmins')->name('vessel.admins.edit')->middleware(['permission:edit own vessels|edit all vessels']);
    Route::put('vessel_operators', 'VesselController@vesselOperators')->name('vessel.operators.edit')->middleware(['permission:edit own vessels|edit all vessels']);

});

/*
|--------------------------------------------------------------------------
| USER routes
|--------------------------------------------------------------------------
|*/
Route::prefix('user')->group(function () {
    Route::get('user_create', 'UserController@create')->middleware(['permission:create users']);
    Route::post('user_add', 'UserController@addUser')->name('user.external.add')->middleware('permission:create users')->middleware(['permission:create users']);
    Route::post('user_store', 'UserController@store')->name('user.external.store')->middleware('permission:create users')->middleware(['permission:create users']);
});

