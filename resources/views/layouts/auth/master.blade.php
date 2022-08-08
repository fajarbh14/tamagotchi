<!DOCTYPE html>
<html lang="en" class="h-100">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>DiResto</title>
        @includeIf('layouts.auth.partials.css')
    </head>
    <body class="h-100">
        @yield('content')
        @includeIf('layouts.auth.partials.js')
    </body>
</html>
