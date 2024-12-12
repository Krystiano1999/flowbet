@extends('layouts.site')

@section('title', 'FlowBet - Droga do Miliona')

@section('content')
<div id="hero" class="hero-section position-relative overflow-hidden text-white text-center">
    <div class="hero-overlay"></div>
    <div class="container position-relative z-index-1">
        <h1 class="display-3 fw-bold text-uppercase mb-4">FlowBet</h1>
        <p class="lead mb-5">Twoja strategia zakładów – od 2 zł do miliona w 20 krokach!</p>
        <a href="#cta" class="btn btn-warning btn-lg shadow-lg px-5 scroll-link">
            Przejdź do Panelu <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
    <div class="hero-decorations">
        <div class="circle circle-primary"></div>
        <div class="circle circle-secondary"></div>
    </div>
</div>

<section id="features" class="features-section py-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="feature-card p-4 bg-white shadow rounded">
                    <i class="fas fa-shoe-prints fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold text-secondary">20 Kroków</h3>
                    <p>Strategia krok po kroku, prowadząca Cię do celu. Podwajaj kupony i zwiększaj swoje wygrane.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 bg-white shadow rounded">
                    <i class="fas fa-ticket-alt fa-3x text-success mb-3"></i>
                    <h3 class="fw-bold text-secondary">Dodawaj Kupony</h3>
                    <p>Poszerzaj swoje możliwości! Dodaj dowolną liczbę kuponów, aby zwiększyć swoje szanse.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 bg-white shadow rounded">
                    <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                    <h3 class="fw-bold text-secondary">Monitoruj Wyniki</h3>
                    <p>Pełna kontrola nad finansami – sprawdzaj wpłaty, wypłaty i bilans w czasie rzeczywistym.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="how-it-works" class="how-it-works py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Jak to działa?</h2>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('img/grow.webp') }}" alt="FlowBet strategy" class="img-fluid rounded shadow-lg">
            </div>
            <div class="col-md-6">
                <p class="lead mb-4">FlowBet to prosty system zakładów. Startujesz z kwotą 2 zł i przez 20 kroków budujesz swoją drogę do miliona. Dzięki dokładnym analizom i możliwości dodania nadprogramowych kuponów, Twój sukces jest w Twoich rękach.</p>
                <a href="#cta" class="btn btn-primary btn-lg shadow-lg scroll-link">Dowiedz się więcej</a>
            </div>
        </div>
    </div>
</section>

<section id="cta" class="cta-section py-5 text-center bg-dark text-white">
    <div class="container">
        <h2 class="fw-bold mb-3">Zacznij teraz swoją drogę do miliona!</h2>
        <p class="lead mb-4">Dołącz do FlowBet i zobacz, jak osiągnąć sukces krok po kroku.</p>
        <a href="{{ route('login.view') }}" class="btn btn-success btn-lg shadow-lg px-5">
            Przejdź do Panelu <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<footer class="text-center py-4 bg-primary text-white">
    <p class="mb-0">&copy; 2024 FlowBet. Wszystkie prawa zastrzeżone. Stworzono z pasją.</p>
</footer>
@endsection
