@extends('layouts.auth')

@section('title', 'Logowanie')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-white rounded-custom shadow px-2 py-4">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-12">
            <div class="p-4">
                <h2 class="mb-4 text-start">Logowanie</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary px-3">Zaloguj się</button>
                </form>
                <p class="mt-3 text-left">
                    Nie masz konta? <a class="text-secondary fw-bold" href="{{ route('register.view') }}">Zarejestruj się</a>
                </p>
            </div>
        </div>

        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="{{ asset('img/login.png') }}" alt="Logowanie" class="img-fluid">
        </div>
    </div>
</div>
@endsection
