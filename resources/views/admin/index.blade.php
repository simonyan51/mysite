<!DOCTYPE html>
<html>
@include('admin.layout.head.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include('admin.layout.header.header')
  @include('admin.layout.sidebar.sidebar')
  @yield('dashboard1')
  @yield('simple_table')
  @yield('movies_list')
  @yield('movie_show')
  @yield('add_movie')
  @yield('edit_movie')
  @yield('genres_list')
  @yield('genre_show')
  @yield('add_genre')
  @yield('edit_genre')
  @include('admin.layout.footer.footer')
</div>
@include('admin.layout.sidebar.right_sidebar')
@include('admin.layout.scripts.scripts')
</body>
</html>
