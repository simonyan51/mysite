@extends('client.index')

@section('theaters')
<style>
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
</style>
<div class="content-wrapper, interface">
	<h1>Order Movie: "{{$movie->movie_name}}"</h1>
	<hr>
	<br>
	<h1>Select Theater Please</h1>
	<div class="row">
		<div id="redTheater" class="theaters col-sm-4"><a href="/client/movies/{{$movie -> id}}/order_movie/green_theater"><h2 class="title">Green Theater</h2><img src="{{asset('dist/img/theaters/green.jpg')}}"/></a></div>
		<div id="blueTheater" class="theaters col-sm-4"><a href="/client/movies/{{$movie -> id}}/order_movie/blue_theater"><h2 class="title">Blue Theater</h2><img src="{{asset('dist/img/theaters/blue.jpg')}}"/></a></div>
		<div id="greenTheater" class="theaters col-sm-4"><a href="/client/movies/{{$movie -> id}}/order_movie/red_theater"><h2 class="title">Red Theater</h2><img src="{{asset('dist/img/theaters/red.jpg')}}"/></a></div>
	</div>
	<hr />
	<a class="btn btn-primary" href="/client/movies/{{$movie -> id}}">Back</a>
	
@stop