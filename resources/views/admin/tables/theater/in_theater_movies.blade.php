@extends('admin.index')

@section('in_theaters')
  <style>
    .movie-image {
      width: 70px;
      height: 100px;
    }
  </style>
  <script>
    $(document).ready(function() {
      $(document).on("click", ".pagination a", function(e) {
          e.preventDefault();
          var page = $(this).attr("href").split("page=")[1];
          getProducts(page);
        });

        function getProducts(page) {
          $.ajax({
            url: "/admin/tables/movies?page=" + page,
            type: 'get'
          }).done(function(data) {

            $(".wrapper").html(data);

            location.hash = page;
          });
      }
    });
  </script>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Movies In Theaters
        <small>advanced lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Lists</a></li>
        <li class="active">Movies In Theaters</li>
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
            <a href="/admin/tables/movies/add_movie"><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                    <td>Rating</td>
                    <td>Publish Time</td>
                    <td>Publish</td>
                    <td>In Theaters Time</td>
                    <td>Show Movie</td>
                    <td>Edit Movie</td>
                    <td>Remove Movie</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($movies as $movie)
                    <tr>
                      <td><img src="{{asset('uploads/'.$movie->image)}}" class="movie-image" /></td>
                      <td><a href="{{asset('admin/tables/in_theaters/movies/'.$movie->id.'/orders')}}">{{$movie->movie_name}}</a></td>
                      <td>{{$movie->year}}</td>
                      <td>{{$movie->country}}</td>
                      <td>
                        @foreach($movie -> genres as $genre) 
                          <a href="/admin/tables/genres/{{$genre -> id}}" >{{$genre -> genre}}</a> 
                        @endforeach
                      </td>
                      <td>{{$movie->producer}}</td>
                      <td>{{$movie->time}}</td>
                      <td>{{$movie->rating}}</td>
                      <td>{{$movie->publish_time}}</td>
                      @if($movie->publish == 0)
                      <td><a href="/admin/tables/movies/{{$movie->id}}/publish"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                      @else
                      <td><a href="/admin/tables/movies/{{$movie->id}}/unpublish"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></td>
                      @endif
                      <td>{{$movie -> in_theaters_time}}</td>
                      <td><a href="/admin/tables/movies/{{$movie->id}}"><i class="fa fa-info" aria-hidden="true"></i></a></td>
                      <td><a href="/admin/tables/movies/{{$movie->id}}/edit_movie"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                      <td><a href="/admin/tables/movies/{{$movie->id}}/delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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