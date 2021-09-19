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
    return view('login');
});

Route::get('/actlog', 'App\Http\Controllers\Controller@actlog');

Route::get('/bupati', 'App\Http\Controllers\Controller@bupati');
Route::get('/dt_resume', 'App\Http\Controllers\Controller@dtresume');
Route::post('/resume:upd={id}', 'App\Http\Controllers\Controller@updresume');



Route::get('/ajudan', 'App\Http\Controllers\Controller@ajudan');
Route::get('/dt_acara', 'App\Http\Controllers\Controller@dtacara');
Route::post('/add_acara', 'App\Http\Controllers\Controller@addacara');
Route::post('/acara:upd={id}', 'App\Http\Controllers\Controller@updacara');
Route::get('/acara:del={id}', 'App\Http\Controllers\Controller@delacara');
Route::get('/peserta:data={id}', 'App\Http\Controllers\Controller@adtpes');
Route::post('/add_resume', 'App\Http\Controllers\Controller@addresume');



Route::get('/surveior', 'App\Http\Controllers\Controller@surveior');
Route::get('/sdt_acara', 'App\Http\Controllers\Controller@sdtacara');
Route::get('/acara:pes={id}', 'App\Http\Controllers\Controller@dtpes');
Route::post('/add_peserta', 'App\Http\Controllers\Controller@addpes');
Route::post('/peserta:upd={id}', 'App\Http\Controllers\Controller@updpes');
Route::get('/peserta:del={id}', 'App\Http\Controllers\Controller@delpes');



Route::get('/logout', 'App\Http\Controllers\Controller@logout');
