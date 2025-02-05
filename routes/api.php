<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/latest-users', function (Request $request) {
    return User::latest()->limit(5)->get();
});
