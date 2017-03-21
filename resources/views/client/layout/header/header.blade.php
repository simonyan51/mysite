<div id="header">
		<h1 id="logo"><a href="/client/movies">Simonyan Movies</a></h1>
		<div class="social">
			<span>FOLLOW US ON:</span>
			<ul>
			    <li><a class="twitter" href="#">twitter</a></li>
			    <li><a class="facebook" href="#">facebook</a></li>
			    <li><a class="vimeo" href="#">vimeo</a></li>
			    <li><a class="rss" href="#">rss</a></li>
			</ul>
		</div>
		
		<!-- Navigation -->
		<div id="navigation">
			<ul>
			    <li><a class="active" href="/client/movies">HOME</a></li>
			    <li><a href="/client/movies/news">NEWS</a></li>
			    <li><a href="/client/movies/in_theaters">IN THEATERS</a></li>
			    <li><a href="/client/movies/coming_soom">COMING SOON</a></li>

			    @if(Auth::user() and Auth::user() -> admin === 1)
			    <li><a href="/admin/dashboards/dashboard1">ADMIN PANEL</a></li>
			    @endif

			    @if(Auth::user())
			    <li><a href="/logout">LOG OUT</a></li>
			    @else 
			    <li><a href="/login">LOG IN</a></li>
			    @endif
			</ul>
		</div>
		<!-- end Navigation -->
		
		<!-- Sub-menu -->
		<div id="sub-navigation">
			<ul>
			    <li><a href="#">SHOW ALL</a></li>
			    <li><a href="#">LATEST TRAILERS</a></li>
			    <li><a href="{{asset(url('/client/movies/top_rated'))}}">TOP RATED</a></li>
			    <li><a href="#">MOST COMMENTED</a></li>
			</ul>
			<div id="search">
				<form action="{{url('/client/movies/search')}}" method="post" accept-charset="utf-8">
					<label for="search-field">SEARCH</label>					
					<input type="text" name="search" id="search-field" title="Enter search here" class="blink search-field"  />
					<input type="submit" value="GO!" class="search-button" />

					{{ csrf_field() }}
				</form>
			</div>
		</div>
		<!-- end Sub-Menu -->
		
	</div>