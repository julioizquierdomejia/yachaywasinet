<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('images/favicon-xs.png') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('images/favicon-xs.png') }}" type="image/x-icon">
        <link rel="canonical" href="{{url()->current()}}" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
        <!-- Font Awesome Icons -->
        <link href="/online/css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

        @yield('css')
        <title>{{!empty($title) ? $title . ' | ' : ''}}Yachaywasinet</title>
        <meta name="description" content="{{isset($description) ? strip_tags($description): 'Gestión de colegio'}}">
        <meta name="og:title" content="{{!empty($title) ? $title . ' | ' : ''}}Yachaywasinet">
        <meta name="og:description" content="{{isset($description) ? strip_tags($description): 'Gestión de colegio'}}">
    </head>
    <body class="page {{!empty($body_class) ? $body_class : ''}}" id="page-top">
        <div id="app">
        <header>
            @include('online.partials.header')
            @yield('header')
        </header>
        <main class="main d-flex flex-column">
            <div class="page-container py-3 py-md-5">@yield('page-content')</div>
            @include('online.partials.footer')
        </main>
        </div>
        {{-- Scripts --}}
        <script src="{{ mix('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
