<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('home');
})->where('any', '^(?!api/|sanctum/csrf-cookie).*$');

// Override Laravel's default 404 response
Route::fallback(function () {
    return response()->view('not-found', [], 404);
});
