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

Route::get('/', function () {
    return redirect('/login');
})->name('home');


/*Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('mylist', 'App\Http\Controllers\MyListController');
Route::post('api/mylist/datatable', [
    'uses' => 'App\Http\Controllers\MyListController@datatable',
    'as' => 'api.mylist.datatable'
]);
Route::post('api/mylist/addItem', [
    'uses' => 'App\Http\Controllers\MyListController@addItem',
    'as' => 'api.mylist.addItem'
]);
Route::get('api/mylist/showItems', [
    'uses' => 'App\Http\Controllers\MyListController@showItems',
    'as' => 'api.mylist.showItems'
]);

Route::post('api/mylist/deleteItems', [
    'uses' => 'App\Http\Controllers\MyListController@deleteItem',
    'as' => 'api.mylist.deleteItem'
]);


