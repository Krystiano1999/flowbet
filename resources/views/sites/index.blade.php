@extends('layouts.site')

@section('title', 'FlowBet - Droga do Miliona')

@section('content')
<div class="hero-section bg-primary text-white text-center py-5">
    <div class="container">
        <h1 class="display-3 fw-bold">FlowBet</h1>
        <p class="lead">Twoja taktyka podwajania zakładów - od 2 zł do miliona w 20 krokach!</p>
        <a href="#" class="btn btn-warning btn-lg mt-3">
            Przejdź do Panelu <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</div>

<section class="features-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 bg-light shadow-sm">
                    <i class="fas fa-shoe-prints fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold text-secondary">20 Kroków</h3>
                    <p>Przemyślana strategia, która krok po kroku prowadzi Cię do celu. Podwajaj kupony i zwiększaj wygraną.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 bg-light shadow-sm">
                    <i class="fas fa-ticket-alt fa-3x text-success mb-3"></i>
                    <h3 class="fw-bold text-secondary">Dodawaj Kupony</h3>
                    <p>Zwiększaj swoje szanse! Dodawaj dowolną liczbę kuponów w każdym kroku, by maksymalizować wygraną.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 bg-light shadow-sm">
                    <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                    <h3 class="fw-bold text-secondary">Monitoruj Wyniki</h3>
                    <p>Pełna kontrola nad finansami – sprawdź, ile wpłaciłeś, wypłaciłeś i jaki jest Twój bilans.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="how-it-works py-5 bg-secondary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Jak to działa?</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('img/grow.webp') }}" alt="FlowBet strategy" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <p class="lead">FlowBet to prosty system, w którym zaczynasz od małej kwoty – 2 zł. W każdym z 20 kroków wybierasz 5 kuponów, które podwajają Twoje szanse na wygraną. Możesz także dodać kupony nadprogramowe.</p>
                <p>Po każdym kroku bilans jest automatycznie aktualizowany, dzięki czemu masz pełną kontrolę nad swoimi finansami.</p>
                <a href="#" class="btn btn-light btn-lg mt-3">Dowiedz się więcej</a>
            </div>
        </div>
    </div>
</section>

<section class="cta-section py-5 text-center bg-dark text-white">
    <div class="container">
        <h2 class="fw-bold">Zacznij teraz swoją drogę do miliona!</h2>
        <p class="lead">Nie czekaj – dołącz do FlowBet i zobacz, jak łatwo możesz osiągnąć sukces.</p>
        <a href="#" class="btn btn-success btn-lg mt-3">
            Przejdź do Panelu <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>
</section>

<footer class="text-center py-4 bg-primary text-white">
    <p>&copy; 2024 FlowBet. Wszystkie prawa zastrzeżone.</p>
</footer>
@endsection
