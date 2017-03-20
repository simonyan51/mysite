@extends('admin.index')

@section('genres_list')
  
  <style>
    .add-button {
      background-color: #3278B4;
      color: #FEFEFE;
      border: 0;
    }

    .error-message {
      list-style-type: none;
      width: 40%;
      padding: 10px;
      background-color: #FE3C60; 
      color: white;
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
            url: "/admin/tables/genres?page=" + page
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
        Genres List
        <small>advanced lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Lists</a></li>
        <li class="active">Genres List</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Genres List</h3>
            </div>
            <div class="box-body">
            @if (count($errors) > 0)
              <ul>
                @foreach($errors -> all() as $error)
                  <li class="error-message">{{$error}}</li>
                @endforeach
              </ul>
            @endif
            <form action="{{URL::to('/admin/tables/genres/')}}" method="post" name="add_form" >
              <label>Add Genre:</label> <input type="text" name="genre_name" placeholder="Genre Name" />
              <button type="submit" name="add" class="add-button"><i class='fa fa-plus' aria-hidden='true'></i></button>
              {{ csrf_field() }}
            </form>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <td>ID</td>
                    <td>Genre Name</td>
                    <td>Edit Genre</td>
                    <td>Remove Genre</td>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($genres as $genre)
                    <tr>
                      <td>{{$genre->id}}</td>
                        <td id="editedTagName{{$genre->id}}"><a href="/admin/tables/genres/{{$genre -> id}}" >{{$genre->genre}}</a></td>
                        <td  id="editedButtonName{{$genre->id}}" ><a onclick="editTag('{{$genre->id}}', '{{$genre->genre}}', 'genre_name')"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                      <td><a href="/admin/tables/genres/{{$genre->id}}/delete"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                  
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {!! $genres -> links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @stop