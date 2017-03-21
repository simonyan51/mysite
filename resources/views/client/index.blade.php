<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
@include('client.layout.head.head')
<body>
	<div id="shell">
		@include('client.layout.header.header')
		<div id="main">
			<div id="topbar" style="height: 175px; margin: 5px;">
				<input type="text" name="selected_date" id="datepicker" style="display: none" />
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div id="calendar" style="width: 220px; float: left"></div>
				<div class="categories-list" style="border: 1px solid white; float: left; padding: 5px; height: 160px; width: 400px">
					<h1>Select By Genres</h1>
					@foreach($genres as $genre)
					<span style="font-size: 16px; padding: 3px"><a style=" color: #ccc; text-decoration: none;" href="/client/movies/genres/{{$genre -> id}}">{{$genre -> genre}}</a></span>
					@endforeach
				</div>
			</div>
			@yield('movies_list')
			@yield('movie_show')
			@yield('news')
			@yield('theaters')
			@yield('red_theater')
			@yield('green_theater')
			@yield('blue_theater')
			<div class="cl">&nbsp;</div>
		</div>
		@include('client.layout.footer.footer')
	</div>
		@include('client.layout.scripts.scripts')
</body>
</html>