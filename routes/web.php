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

Route::get('/home', function () {
    return view('welcome');
});

Route::resource('/customers', 'CustomerController');
Route::resource('/students', 'StudentController');
Route::resource('/books', 'BookController');
Route::resource('/debtors', 'DebtorController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/main', function(){
        return view('admin.index');
    })->name('dashboard');
    
});

Route::get('/test', function(){
    return "Hello world";
})->name('test');

Route::prefix('api')->group(function () {
    Route::get('/students', 'FetchController@index')->name("getAllStudents");
    Route::get('/students/{id}', 'FetchController@getStudent')->name("getStudent");
    Route::get('/books/{id}', 'FetchController@getBook')->name("getBook");
    Route::post('/attach', 'FetchController@attach')->name("attach");
});

Route::get('/test', function () {
    return Debtor::find(1)->student;
});