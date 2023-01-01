<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Events\Userlogged;
use App\Notifications\NewVisitor;
use App\Notifications\TelegramNotif;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SendMailController;

app()->bind('contoh', function() {
    return new App\Tabungan;
});

Route::get('/text', function (Request $request) {
    // dd(app('contoh'));
    event(new UserLogged($request));
    return $request->text;
});

Route::get('/', function () {
    $user = Auth::user();
    $user->notify(new NewVisitor("Welcome {$user->name}"));

    $user->notify(new TelegramNotif());

    return view('welcome');
});

Route::get('/email/send', [SendMailController::class, 'sendMail']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
