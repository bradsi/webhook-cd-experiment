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

// Test webhook on staging

Route::get('/', function () {
    return 'The webhook is working, CD now set up for a staging environment';
//    return view('welcome');
});

Route::webhooks('webhooks/deploy', 'deploy'); // route name = webhook-client-deploy
