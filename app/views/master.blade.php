<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Automation</title>
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="/css/main.css">


    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/main.js"></script>
</head>
<body>
    @include('includes.nav');
    <div class="container">
    @yield('container')
    </div>
</body>
</html>
