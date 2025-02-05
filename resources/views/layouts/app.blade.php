<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="">
    <title>@yield('title', 'Dashboard - Bank Application')</title>

    @include('partials.link')

    @vite('resources/js/app.js') 
    @vite('resources/css/app.css') 
</head>
<body class="theme-black">

    @include('partials.header')

    @yield('content')

    @include('partials.script')
</body>  
</html>
