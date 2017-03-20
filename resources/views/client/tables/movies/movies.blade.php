  <style>
    .form {
      display: inline-block;
    }

    <style>
    .movie-image {
      width: 10px;
      height: 10px;
    }
  </style>
  </style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Movies List
        <small>advanced lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Lists</a></li>
        <li class="active">Movies List</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Movies List</h3>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <td>Picture</td>
                    <td>Movie Name</td>
                    <td>Year</td>
                    <td>Country</td>
                    <td>Genre</td>
                    <td>Producer</td>
                    <td>Time</td>
                    <td>Show Movie</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($movies as $movie)
                    <tr>
                      <td><img src="{{asset('uploads/'.$movie->image)}}" class="movie-image" /></td>
                      <td>{{$movie->movie_name}}</td>
                      <td>{{$movie->year}}</td>
                      <td>{{$movie->country}}</td>
                      <td>
                        @foreach($movie -> genres as $genre)
                        {{$genre["genre"]}} 
                        @endforeach
                      </td>
                      <td>{{$movie->producer}}</td>
                      <td>{{$movie->time}}</td>
                      <td><a href="/client/tables/movies/{{$movie->id}}">Show Movie</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {!! $movies -> links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @stop