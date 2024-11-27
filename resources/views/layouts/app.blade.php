<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="w-100 py-3 px-5 d-flex justify-content-between align-items-center bg-header">
        <div class="title">
            <span class="h1 color-primary mb-0">Flow</span><span class="h1 color-black mb-0">Do</span>
        </div>
        
        <!--<div class="search">Kiedyś będzie szukajka</div>-->

        <div class="notify d-flex align-items-center">
            <div class="icon me-2">
                <i class="far fa-bell"></i>
            </div>
            <div class="icon me-5">
                <i class="far fa-calendar-alt"></i>
            </div>
            <div class="d-block">
                <p class="mb-0 color-black"><strong>{{ now()->locale('pl')->translatedFormat('l') }}</strong></p>
                <p class="mb-0 color-primary"><strong>{{ now()->format('d/m/Y') }}</strong></p>
            </div>
        </div>
    </header>
    <div class="container-fluid bg px-0 app-container">
        <div class="d-flex h-100">
            <div class="menu h-100 position-relative">
                @include('partials.nav')
            </div>
            <div class="content px-5 h-100">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>toastr.options={progressBar:true,}</script>
    <script>
        window.sessionSuccess = @json(session('success'));
        window.sessionError = @json(session('error'));
        window.validationErrors = @json($errors->all());
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
