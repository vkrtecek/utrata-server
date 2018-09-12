@inject('trans', 'App\Model\Service\ITranslationService')

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('inc.styles')
    @yield('stylesheets')
    @include('inc.scripts')
    @yield('preScripts')

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.headerExt')
        @yield('navigation')
        @yield('checkStates')

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
