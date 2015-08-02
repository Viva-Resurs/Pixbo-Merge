<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <!-- Bootstrap files -->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>

    @if ( Config::get('app.debug') )
        <script type="text/javascript">
            document.write('<script src="//localhost:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
        </script>
    @endif


    @yield('links')
    @yield('styles')

<!-- Application files
<link rel="stylesheet" href="style.css">
<script src="script.js"></script>
 -->
</head>
<body>

    <!-- top_nav -->
    @include('navs.topnav')

    <!-- body -->
    @yield('body')
    @yield('footer')

</body>
</html>