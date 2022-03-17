<?php

use App\Http\Controllers\UserlistController;
use App\Models\Userlist;
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
    return view('welcome');
});

// Route::get('users', function () {
//     $data = "khuh";
//     return view('user/users')->with(compact('data'));
// });
Route::get('users', [UserlistController::class, 'Index']);

// Route::any("users",function(){
// $data = Userlist::all();
// echo "<pre>";
// print_r($data->toArray());
// echo "</pre>";
//     return view('user/users')->with($data);
// });
Route::any('user-add', [UserlistController::class, 'UserAdd']);
Route::post('user-add', [UserlistController::class, 'UserAddRecord']);

Route::any('contact', function () {

    return view('pages/contact');
});


Route::get('user-edit/{id}', [UserlistController::class, 'UserUpdate']);



Route::post('user-edit', [UserlistController::class, 'UserUpdateRecord']);

Route::get('user-delete/{id}', [UserlistController::class, 'UserDelete']);



