@extends('layouts.auth')

@section('title', 'Rejestracja')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-white rounded-custom shadow px-2 py-4">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 d-none d-md-flex align-items-center justify-content-center">
            <img src="{{ asset('img/register.png') }}" alt="Rejestracja" class="img-fluid" style="max-height: 80%;">
        </div>

        <div class="col-md-6 col-12">
            <div class="p-4">
                <h2 class="mb-4 text-start">Rejestracja</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Imię:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Potwierdź hasło:</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Zarejestruj się</button>
                </form>
                <p class="mt-3 text-start">
                    Masz już konto? <a class="text-secondary fw-bold" href="{{ route('login.view') }}">Zaloguj się</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
