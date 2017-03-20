<div class="content-wrapper">
	
	<h1>{{$movie->movie_name}}</h1>
	<img src="{{asset('uploads/'.$movie->image)}}">
	<p>Year: {{$movie->year}}</p>
	<p>Country: {{$movie->country}}</p>
	<p>Genre: 
        @foreach($movie -> genres as $genre)
        {{$genre["genre"]}} 
        @endforeach
    </p>
	<p>Producer: {{$movie->producer}}</p>
	<p>Time: {{$movie->time}}</p>
	<p>Starting: {{$movie->starting}}</p>
	<p>Description: {{$movie->descr}}</p>
	<a href="/client/tables/movies">Back</a>

</div>
@stop