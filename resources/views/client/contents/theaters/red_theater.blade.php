@extends('client.index')

@section('red_theater')
<style>
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
</style>
<div class="content-wrapper, interface">
	<h1>Order Movie: "{{$movie->movie_name}}"</h1>
	<hr>
	<br>
	<h1>Red Theater</h1>
	<hr />
	<div class="row" id="matrix"></div>
	<hr>
	<a class="btn btn-primary" href="/client/movies/{{$movie -> id}}/order_movie">Back</a>
	<script>
		var matrix = $("#matrix");
		for (var i = 1; i < 401; i++) {
			var chair = $("<div>" + i + "</div>").attr("class", "chairs").attr("id", "chair" + i).css({ 
				"width": "40px",
				"height": "40px",
				"margin": "5px",
				"display": "inline-block",
				"cursor": "pointer",
				"background-color": "green"
			});
			matrix.append(chair);
		}
	</script>
	@foreach($chairs as $chair)
	<script>
	for (var i = 1; i < 401; i++) {
		if ({{$chair -> chair}} === +($("#chair" + i).html()) && {{$chair -> movie_id}} === {{$movie -> id}} && {{$chair -> theater_id}} === 3) {
			$("#chair" + i).css("background-color", "rgb(255, 0, 0)");
			break;
		}
	}
	</script>
	@endforeach
	<script>
		$(".chairs").click(function() {
			var color = $(this).css("background-color");
			if (color === "rgb(255, 0, 0)") {
				return false;
			}
			$.ajax({
				type: "get",
				url: "/client/movies/" + {{$movie -> id}} + "/order_movie/red_theater",
				data: {"chair_id": $(this).html()},
				success: $(this).css({"background-color": "red"}),
			});
		});
	</script>
	
@stop