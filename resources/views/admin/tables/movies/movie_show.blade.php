@extends('admin.index')

@section('movie_show')
<style>
	.descr {
		float: right;
		width: 60%;
	}

	.movie-image {
		float: left;
		width: 38%;
	}
</style>
<div class="content-wrapper">
	<div class="box-body">
		<h1>{{$movie->movie_name}}</h1>
		<img src="{{asset('uploads/'.$movie->image)}}" class="movie-image" />
		<div class="descr">
			<p>Year: {{$movie->year}}</p>
			<p>Country: {{$movie->country}}</p>
			<p>Genre<br />
		    @foreach($movie -> genres as $genre) 
		        {{$genre -> genre}} 
		    @endforeach
		    </p>
			<p>Producer: {{$movie->producer}}</p>
			<p>Time: {{$movie->time}}</p>
			<p>Rating: {{$movie->rating}}</p>
			<p>Starting: {{$movie->starting}}</p>
			<p>Description: {{$movie->descr}}</p>
			<p>Publish Time: {{$movie->publish_time}}</p>
			<p>In Theaters Time: {{$movie -> in_theaters_time}}</p>
		</div>
	</div>
	<a href="/admin/tables/movies" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
</div>
@stop