<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/howtoder', function () {
    return view('howtoder', ['title' => 'Home  How To Order']);
});

Route::get('/category', function () {
    return view('category', ['title' => 'Home Category']);
});

Route::get('/login', function () {
    return view('login', ['title' => 'Home Category']);
});
