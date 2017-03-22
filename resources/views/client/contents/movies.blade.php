@extends('client.index')

@section('movies_list')
<div id="content">
			<!-- Box -->
			<div class="box">
			<div id="calendar"></div>
				<div class="head">
					<h2>LATEST TRAILERS</h2>
					<p class="text-right"><a href="#">See all</a></p>
				</div>
				
				@foreach($movies as $movie)
				<!-- Movie -->
				<div class="movie selectedMovie{{$movie->id}} movies" style="width: 184.01px;">
					
					<div class="movie-image">
						@if ($movie -> publish_time > $currentDate)
						<span class="play"><span class="name">{{$movie -> movie_name}}</span></span><img src="{{asset('uploads/'.$movie->image)}}" alt="movie" />
						@else
						<a href="/client/movies/{{$movie -> id}}"><span class="play"><span class="name">{{$movie -> movie_name}}</span></span><img src="{{asset('uploads/'.$movie->image)}}" alt="movie" /></a>
						@endif
					</div>
						
					<div class="rating">
						<p>RATING</p>
						<span class="movie-stars" id="ratedStar1"><img src="{{asset('/css/images/star_disabled.png')}}" alt="1" /></span>
						<span class="movie-stars" id="ratedStar2"><img src="{{asset('/css/images/star_disabled.png')}}" alt="2" /></span>
						<span class="movie-stars" id="ratedStar3"><img src="{{asset('/css/images/star_disabled.png')}}" alt="3" /></span>
						<span class="movie-stars" id="ratedStar4"><img src="{{asset('/css/images/star_disabled.png')}}" alt="4" /></span>
						<span class="movie-stars" id="ratedStar5"><img src="{{asset('/css/images/star_disabled.png')}}" alt="5" /></span>
					</div>
				</div>
				
				<script>
					for(i = 1; i <= 5; i++) {
						if ({{$movie -> rating}} == 0) {
							break;
						}
			 			$(".selectedMovie{{$movie->id}} .rating #ratedStar" + i + " img").attr("src", "{{asset('/css/images/star_enabled.png')}}");
						if ($(".selectedMovie{{$movie->id}} .rating #ratedStar" + i + " img").attr("alt") == {{$movie -> rating}}) {
							break;
						}
					}
				</script>
				@endforeach
				<div class="cl">&nbsp;</div>
			</div>
			<!-- end Box -->
			
</div>
@stop