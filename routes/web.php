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
use App\Student;
use App\Book;
Route::redirect('/', '/give', 301);
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('/customers', 'CustomerController');
    Route::resource('/students', 'StudentController');
    Route::resource('/books', 'BookController');
    Route::get('/debtors', 'DebtorController@index')->name('debtors.index');
    Route::get('/debtors/{student}', 'DebtorController@show')->name('debtors.show');
    Route::view('/importBooks', 'admin.import_book')->name('importBook');
    Route::post('/importBooks', 'FetchController@importBook')->name('import_books');
    Route::view('/importStudents', 'admin.import_student')->name('importStudents');
    Route::post('/importStudents', 'FetchController@importStudent')->name('import_students');
    Route::post('/authStudent', 'StudentController@checkAuth');
    Route::get('/give', function(){
        return view('admin.index');
    })->name('dashboard');
    Route::get('/take', function(){
        return view('admin.take');
    })->name('take');

});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('api')->group(function () {
    Route::get('/students', 'FetchController@index')->name("getAllStudents");
    Route::get('/students/{id}', 'FetchController@getStudent')->name("getStudent");
    Route::get('/students/debtor/{id}', 'FetchController@getDebtorStudent')->name("getDebtorStudent");
    Route::get('/books/{id}', 'FetchController@getBook')->name("getBook");
    Route::post('/attach', 'FetchController@attach')->name("attach");
});
