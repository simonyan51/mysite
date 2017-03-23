@extends('admin.index')

@section('order')
  </script>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Order List
        <small>advanced lists</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">Ordered Chairs For {{$movie -> movie_name}}</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ordered Chairs For {{$movie -> movie_name}}</h3>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <td>Client Name</td>
                    <td>Theater Name</td>
                    <td>Chair Number</td>
                    <td>Order Time</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($chairs as $chair) 
                  <tr>
                  <?php
                    foreach($users as $user) {
                          if ($user -> id === $chair -> user_id) {
                            echo "<td>" . $user -> name . "</td>";
                          break;
                      }
                    }
                    foreach($theaters as $theater) {
                          if ($theater -> id === $chair -> theater_id) {
                            echo "<td>" . $theater -> theater . "</td>";
                          break;
                      }
                    }
                    ?>
                    <td>{{$chair -> chair}}</td>
                    <td>{{$chair -> updated_at}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                {!! $chairs -> links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @stop