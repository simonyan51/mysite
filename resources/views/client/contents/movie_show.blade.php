@extends('client.index')

@section('movie_show')
<style>
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	.stars img{
		width: 15px;
		height: 15px;
	}
</style>
<div class="content-wrapper, interface">
	<h1>{{$movie->movie_name}}</h1>
	<hr>
	<br>
	<div class="image-content">
	<img src="{{asset('uploads/'.$movie->image)}}">
	@if(Auth::check())
		@if($ratedUser)
		<p id>Thanks For Rating</p>
		@else
	<p>------Rate Movie Please------</p>
	<div class="rating">
		<fieldset class="rating">
		    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
		    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
		    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
		    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
		    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
		    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
		    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
		    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
		    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
		    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
		    {{ csrf_field() }}
		</fieldset>
	</div>
		@endif
	@else
	<p>Please, Log In For Rating</p>
	@endif
	</div>
	<div class="descrs"><p><span class="titles">Year:</span> {{$movie->year}}</p>
	<br>
	<p><span class="titles">Country:</span> {{$movie->country}}</p>
	<br>
	<p><span class="titles">Genre:</span> 
        @foreach($movie -> genres as $genre)
        {{$genre -> genre}} 
        @endforeach
    </p>
    <br>
	<p><span class="titles">Producer:</span> {{$movie->producer}}</p>
	<br>
	<p><span class="titles">Time:</span> {{$movie->time}}</p>
	<br>
	<p><span class="titles">Starting:</span> {{$movie->starting}}</p>
	<br>
	<p><span class="titles">Rating:</span>
		<span class="stars" id="ratedStar1"><img src="{{asset('/css/images/star_disabled.png')}}" alt="1" /></span>
		<span class="stars" id="ratedStar2"><img src="{{asset('/css/images/star_disabled.png')}}" alt="2" /></span>
		<span class="stars" id="ratedStar3"><img src="{{asset('/css/images/star_disabled.png')}}" alt="3" /></span>
		<span class="stars" id="ratedStar4"><img src="{{asset('/css/images/star_disabled.png')}}" alt="4" /></span>
		<span class="stars" id="ratedStar5"><img src="{{asset('/css/images/star_disabled.png')}}" alt="5" /></span>
	</p>
	<br>
	<p><span class="titles">Publish Time: </span> {{$movie -> publish_time}}</p>
	<br />
	<p><span class="titles">In Theaters To: </span> {{$movie -> in_theaters_time}}</p>
	<br />
	<p><span class="titles">Description:</span> {{$movie->descr}}</p>
	<br>
	<a class="back" href="/client/movies">Back</a>
	</div>
	<div class="clear-both"></div>
	<hr />
	<div class="comments-block">
	<h1>Commentaries</h1>
	<div class="comments" id="comments">
		@foreach($movie -> comments as $comment)
        <p><span style='color: red'>{{$comment -> user_name}}</span>: {{$comment -> comment}}<br /><span style='color: blue'>Time: {{$comment -> time}}</span></p> 
    	@endforeach
    </div>
			<div class="clear-both"></div>
			<input type="text" name="comment" class="comments-area" id="commentsArea" placeholder="Leave Comments Here"/><br /><br />
			<div class="clear-both"></div>
			<input type="submit" name="submitComment" value="Go!" id="submitComment" />
			<div class="clear-both"></div>
	</div>
</div>
<script>
	$('input[name="rating"]').click(function(rating) {
		$.ajax({
			type: "get",
			url: "/client/movies/"+ {{$movie -> id}} + "/rating",
			data: {"rating": $(this).val()},
			success: $(".rating").html("<p>Thanks For Rating!</p>")
		});
	});

	for(i = 1; i <= 5; i++) {
		if ({{$movie -> rating}} == 0) {
			break;
		}
 		$("#ratedStar" + i + " img").attr("src", "{{asset('/css/images/star_enabled.png')}}");
		if ($("#ratedStar" + i + " img").attr("alt") == {{$movie -> rating}}) {
			break;
		}
	}
	$("#submitComment").click(function() {
		if ($("#commentsArea").val() === "") {
			$("#commentsArea").css("border", "1px solid red");
			return false;
		}
		$.ajax({
			type: "get",
			url: "/client/movies/" + {{$movie -> id}} + "/comment",
			data: {"user_id": {{Auth::user() -> id}}, "user_name": {{Auth::user() -> name}}, "movie_id": {{$movie -> id}}, "comment": $("#commentsArea").val()},
			success: function() {
				$("#comments").append("<p><span style='color: red'>{{Auth::user() -> name}}:</span> " + $("#commentsArea").val() + "<br /> <span style='color: blue'>Time: " + dateFormat(new Date(), "mm/dd/yy, h:MM:ss TT") + "</span></p>");
			}
		})
	});
</script>
@stop