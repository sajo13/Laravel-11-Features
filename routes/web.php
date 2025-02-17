<?php

use App\Http\Controllers\MailController;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $conversionRates = Http::pool(fn (Pool $pool) => [
        $pool->as('GBP')->retry(3)->get("http://flaky.test/api/conversion/GBP"),
        $pool->as('USD')->retry(3)->get("http://flaky.test/api/conversion/USD"),
        $pool->as('EUR')->retry(3)->get("http://flaky.test/api/conversion/EUR")
    ]);

    return collect($conversionRates)->map(function ($response) {
        if ($response instanceof Response) {
            return $response->body(); // Successful response
        }

        // Handle errors like ConnectionException
        return [
            'error' => true,
            'message' => $response->getMessage() ?? 'An error occurred.'
        ];
    });
});
//
//
//Route::get('/login', function () {
//
////    $uuid = Request::identifier();
////    dump($uuid);
////    $uuid = Request::identifier();
////    dd($uuid);
//
//    $users = User::whereHas('posts')
//        ->with('latestPosts')
//        ->paginate(2);
//
//    return view('login', compact('users'));
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


Route::get('sendmail', [MailController::class, 'index']);

Route::get('jobs', function () {

    foreach (range(1,100) as $index) {
        \App\Jobs\SendWelcomeEmail::dispatch();
    }

    \App\Jobs\ProcessPayment::dispatch()->onQueue('payments');

    return view('welcome');
});
