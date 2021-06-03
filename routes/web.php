<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
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
Route::get('', 'ShortLinkController@index');

Route::get('generate-shorten-link', 'ShortLinkController@index');
Route::post('generate-shorten-link', 'ShortLinkController@store')->name('generate.shorten.link.post');
    
Route::get('{shortlink:code}', 'ShortLinkController@shortenLink')->name('shorten.link');

Route::delete('generate-shorten-link/{shortlink}/delete', 'ShortLinkController@destroy')->name('generate.shorten.link.destroy');
