<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
 
    <title>Online Library System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Library System">
    <meta name="author" content="Jamina Carla San Juan">
    <meta name="keyword" content="Online Library System, Library System, Reservation System">
    <link rel="stylesheet" type="text/css" href="{{URL::to('css/bootstrap.min.css')}}">
    @yield('styles')
  </head>

  <body>
    <div class="container">
       @yield('contents')
    </div>
  </body>

  <script src="{{URL::to('js/jquery.js')}}"></script>
  <script src="{{URL::to('js/bootstrap.min.js')}}"></script>

</html>
