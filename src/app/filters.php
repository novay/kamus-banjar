<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
| Jika Admin belum melakukan aktifitas login, tuju halaman 
| "localhost/admin/masuk"
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('admin/masuk');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
| Jika Admin telah melakukan login, tuju halaman 
| "localhost/admin"
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('admin');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
