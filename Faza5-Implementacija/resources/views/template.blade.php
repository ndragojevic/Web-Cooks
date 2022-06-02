<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        @yield('imports')
        @yield('customImports')
    </head>
    <body>
        @yield('header')
        @yield('content')
        @yield('footer')
    </body>
</html>