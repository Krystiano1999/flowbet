<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="w-100 d-flex justify-content-between align-items-center bg-white shadow">
        <div class="title left-side ps-5 py-2">
            <span class="h1 color-primary mb-0">Flow</span><span class="h1 text-dark mb-0">Do</span>
        </div>
        
        <div class="notify d-flex align-items-center justify-content-end right-side pe-5 py-2">
            <div class="d-block me-4">
                <p class="mb-0 text-dark"><strong>Budżet: </strong><strong id="user-budget">Ładowanie...</strong></p>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <p class="mb-0 text-dark ms-5 me-3"><strong>Witaj, {{ auth()->user()->name }}</strong></p>
                <div class="user-photo d-flex justify-content-center align-items-center bg-info text-white rounded-circle">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid bg-light px-0 app-container">
        <div class="d-flex h-100">
            <div class="menu h-100 position-relative">
                @include('partials.nav')
            </div>
            <div class="content p-4 h-100">
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
    <script type="module" src="{{ asset('js/budget.js') }}"></script>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
