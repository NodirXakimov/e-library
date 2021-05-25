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

use App\Debtor;

Route::redirect('/', '/main', 301);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('/customers', 'CustomerController');
    Route::resource('/students', 'StudentController');
    Route::resource('/books', 'BookController');
    Route::resource('/debtors', 'DebtorController');
    Route::get('/main', function(){
        return view('admin.index');
    })->name('dashboard');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->group(function () {
    Route::get('/students', 'FetchController@index')->name("getAllStudents");
    Route::get('/students/{id}', 'FetchController@getStudent')->name("getStudent");
    Route::get('/books/{id}', 'FetchController@getBook')->name("getBook");
    Route::post('/attach', 'FetchController@attach')->name("attach");
});

Route::view('/test', 'ajax');