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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', 'HomeController@index')->name('home');

  Route::group(['middleware' => ['auth']], function () {

      Route::resource('contra','contrasenaController');
      
      Route::get('empleados/info',                        'empleadoController@get_datatable'          )->name('get_datatableempleado');
      Route::resource('empleados','empleadoController');

      //users resource
      Route::get('users/info',                              'UserController@get_datatable'                            )->name('users.get_datatable');
      Route::get('users',                                   'UserController@index'                                    )->name('users.index');
      Route::get('users/create',                            'UserController@create'                                   )->name('users.create');
      Route::get('users/{user}/edit',                       'UserController@edit'                                     )->name('users.edit');
      Route::post('users',                                  'UserController@store'                                    )->name('users.store');
      Route::put('users/{user}',                            'UserController@update'                                   )->name('users.update');
      Route::delete('users/{user}',                         'UserController@destroy'                                  )->name('users.destroy');

});

Auth::routes(['register' => true]);
Route::get('/home', 'HomeController@index')->name('home');
