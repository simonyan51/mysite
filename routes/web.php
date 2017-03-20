<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', "Admin\AdminController@logout");

Route::group(["middleware" => "web"], function() {
	Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
	Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

});

Route::get('/client/movies', 'Client\HomeController@index');
Route::get("/client/movies/in_theaters", "Client\HomeController@inTheaters");
Route::post('/client/movies/search', 'Client\HomeController@search');
Route::get('/client/movies/coming_soom', 'Client\HomeController@comingSoon');
Route::get('/client/movies/top_rated', 'Client\HomeController@topRated');
Route::get('/client/movies/{id}', 'Client\HomeController@show');
Route::get('/client/movies/genres/{id}', 'Client\HomeController@searchByGenre');
Route::get("/client/movies/publishDate/{publishTime}", "Client\HomeController@publishDate");

Route::group(['middleware' => 'auth'], function() {

	Route::get('/client/movies/{id}/rating', "Client\HomeController@rate") -> middleware('rated');
	Route::get("/client/movies/{id}/comment", "Client\HomeController@comment");
	Route::group(['middleware' => 'home'], function() {

	});

	Route::group(['middleware' => 'admin'], function() {
		Route::get('/admin/dashboards/dashboard1', 'Admin\AdminController@index');
		Route::get('/admin/tables/movies', 'Admin\MovieController@index');
		Route::get('/admin/tables/movies/add_movie', 'Admin\AddController@index');
		Route::post('/admin/tables/movies/add_movie', 'Admin\MovieController@create');
		Route::get('/admin/tables/movies/{id}', 'Admin\MovieController@show');
		Route::get('/admin/tables/movies/{id}/edit_movie', 'Admin\EditController@index');
		Route::post('/admin/tables/movies/{id}/edit_movie', 'Admin\MovieController@update');
		Route::get('/admin/tables/movies/{id}/delete', 'Admin\MovieController@destroy');

		Route::get('/admin/tables/movies/{id}/publish', 'Admin\MovieController@publish');
		Route::get('/admin/tables/movies/{id}/unpublish', 'Admin\MovieController@publish');

		Route::get('/admin/tables/genres', 'Admin\GenreController@index');
		Route::post('/admin/tables/genres', 'Admin\GenreController@create');
		Route::get('/admin/tables/genres/{id}/edit_genre', 'Admin\GenreController@update');
		Route::get('/admin/tables/genres/{id}/delete', 'Admin\GenreController@destroy');

		Route::get('/admin/tables/genres/{id}', 'Admin\GenreController@show');

		Route::get('/admin/tables/simple', 'Admin\AdminController@simpleTable');
	});
});