<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{config('app.name', 'UIS')}}</title>
        
        <!-- Google Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        
    </head>
    <body>
        @if(Auth::user()->isStudent())
            @include('inc.studentNav')
            <div class="container" style="margin-top: 50px;">
                @include('inc.messages')
                @yield('content')
            </div>
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
            
        @else
            <div class="container mt-4">
                <div class="alert alert-danger">
                    Unauthorized User
                </div>
            </div>
        @endif

    </body>

    
    
</html>