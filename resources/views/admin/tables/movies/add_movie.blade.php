@extends('admin.index')

@section('add_movie')
<div class="content-wrapper">
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
	<h1>Add Movie</h1>
	<div class="form-group">
		<form action="{{URL::to('/admin/tables/movies/add_movie')}}" method="post" enctype="multipart/form-data" >
			<label>Movie Name</label><input type="text" name="movie_name" class="form-control" placeholder="Enter Movie Name" /><br />
			<label>Year</label><select name="year" class="form-control select2">
				@for($i = 1910; $i < 2040; $i++)
				<option value="{{$i}}">{{$i}}</option>
				@endfor
			</select><br />
			<label>Country</label><input type="text" name="country" class="form-control" placeholder="Enter Country" /><br />
			<label>Genre</label>
			<select name="genre[]" multiple class="form-control select2">
			@foreach($genres as $genre)
				<option value="{{$genre -> id}}">{{$genre -> genre}}</option>
			@endforeach
			</select><br />
			<label>Producer</label><input type="text" name="producer" class="form-control" placeholder="Producer Name" />
			<label>Time</label><input type="text" name="time" class="form-control" placeholder="Time" /><br />
			<label>Starting</label><input type="text" name="starting" class="form-control" placeholder="Starting" /><br />
			<label>Description</label><textarea name="descr" class="form-control" placeholder="Description"></textarea><br />
			<label>Image</label><input type="file" name="image" id="exampleInputFile" /><br />
			<label>Publish Time</label>
			<div id="datetimepicker1" class="input-append date">
		      <input type="text" name="publish_time" placeholder="Select Publish Time" />
		      <span class="add-on">
		        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		      </span>
		    </div>
		    <label>In Theaters Time</label>
			<div id="datetimepicker2" class="input-append date">
		      <input type="text" name="in_theaters_time" />
		      <span class="add-on">
		        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
		      </span>
		    </div>
			<input type="submit" class="btn btn-primary" name="add" value="Add" /><br />
			{{ csrf_field() }}
		</form>
		<a href="/admin/tables/movies" class="btn btn-default"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
	</div>
</div>
@stop