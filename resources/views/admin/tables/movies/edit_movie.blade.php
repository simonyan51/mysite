@extends('admin.index')

@section('edit_movie')
<div class="content-wrapper">
	
	<h1>Edit Movie</h1>

	@if (count($errors) > 0)
	<div class="example-modal">
        <div class="modal modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <h4 class="modal-title">Warning</h4>
              </div>
              <div class="modal-body">
                <ul>
					@foreach($errors -> all() as $error)
					<li style="list-style-type: none">{{$error}}</li>
					@endforeach
				</ul>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
	@endif
<div class="box-body">
<div class="form-group">
	<form action="{{URL::to('/admin/tables/movies/'.$movie->id.'/edit_movie')}}" method="post" enctype="multipart/form-data" >
		<label>Movie Name</label><input class="form-control" type="text" name="movie_name" value="{{$movie -> movie_name}}" /><br />
		<label>Year</label><select class="form-control select2"  name="year">
			@for($i = 1910; $i < 2040; $i++)
			<option value="{{$i}}">{{$i}}</option>
			@endfor
		</select><br />
		<label>Country</label><input class="form-control" type="text" name="country" value="{{$movie -> country}}" /><br />
		<label>Genre</label><br />
		<select name="genre[]" multiple class="form-control select2" >
		@foreach($genres as $genre)
			<option value="{{$genre -> id}}">{{$genre -> genre}}</option>
		@endforeach
		</select><br />

		<label>Producer</label><input class="form-control" type="text" name="producer" value="{{$movie -> producer}}" /><br />
		<label>Time</label><input class="form-control" type="text" name="time" value="{{$movie -> time}}" /><br />
		<label>Starting</label><input class="form-control" type="text" name="starting" value="{{$movie -> starting}}" /><br />
		<label>Description</label><textarea class="form-control" name="descr">{{$movie -> descr}}</textarea><br />
		<label>Image</label><input type="file" name="image" /><br />
		<label>Publish Time</label>
			<div id="datetimepicker" class="input-append date">
		      <input type="text" name="publish_time" value="{{$movie -> publish_time}}" />
		      <span class="add-on">
		        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		      </span>
		    </div>
		<label>In Theater Time</label>
			<div id="datetimepicker1" class="input-append date">
		      <input type="text" name="in_theaters_time" value="{{$movie -> in_theaters_time}}" />
		      <span class="add-on">
		        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		      </span>
		    </div>
		<input type="submit" name="edit" class="btn btn-primary" value="Edit" />
		{{ csrf_field() }}
	</form>
	<a href="/admin/tables/movies" class="btn btn-default" ><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
</div>
</div>
</div>
@stop