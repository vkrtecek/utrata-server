@inject('trans', 'App\Model\Service\ITranslationService')

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    @include('inc.styles')
    @yield('stylesheets')

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
{{ app()->getLocale() }}
<div id="app">
    @include('inc.header')
    @yield('navigation')

    @yield('content')
</div>


<!-- Scripts -->
@include('inc.scripts')
@yield('scripts')
</body>
</html>