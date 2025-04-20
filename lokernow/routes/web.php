<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('saved-jobs');
});
Route::get('/search-jobs', function () {
    return view('search-jobs');
});
