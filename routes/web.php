<?php

use Illuminate\Support\Facades\Route;
use App\Http\Requests\CreateUserRequest;
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
Route::post('/', function (CreateUserRequest $request){
    dd($request->all());
})->name('add-user');

