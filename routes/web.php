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
Route::get('/s1', function () {
    Telegram::sendMessage([
        "chat_id" => '-1001207376632',
        "text" => "MESSAGE",
        'parse_mode' => 'Markdown',
    ]);
});
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');
