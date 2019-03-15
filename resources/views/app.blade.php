<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      
    </head>
    <body>
        <div id="app">
            @auth
                // The user is authenticated...
                <app logged_user="{{ auth()->user()->full_name }}"></app>
            @endauth
            
            @guest
                // The user is not authenticated...
                <app logged_user=""></app>
            @endguest
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
