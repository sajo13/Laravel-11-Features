<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

//    dump('hello world');
//
//    dd('hello end execution');

//    User::with('notifications')->latest()->limit(5)->dd()->get();

//    str('Hello')->append('World')->apa()->dump()->toString();

    return view('welcome');
});


Route::get('/login', function () {
    $users = User::whereHas('posts')
        ->with('latestPosts')
        ->paginate(2);

    return view('login', compact('users'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
