<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{config('app.name')}}</title>
    <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  </head>
  <body>

  <div class="container">
    @yield('content')
  </div>
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      if (location.hash) {
        if (location.hash.substr(1) == 'print') {
          window.print();
        }
      }
    });
  </script>
  </body>
</html>
