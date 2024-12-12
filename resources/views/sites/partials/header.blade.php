<header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top">
    <div class="container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="navbar-brand fw-bold d-flex align-items-center">
            <span class="h1 text-primary mb-0">Flow</span><span class="h1 text-dark mb-0">Bet</span>
        </a>

        <!-- Hamburger Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#features" class="nav-link text-dark fw-bold scroll-link">Funkcje</a>
                </li>
                <li class="nav-item">
                    <a href="#how-it-works" class="nav-link text-dark fw-bold scroll-link">Jak działa?</a>
                </li>
                <li class="nav-item">
                    <a href="#cta" class="nav-link text-dark fw-bold scroll-link">Dołącz teraz</a>
                </li>
            </ul>

            <!-- CTA -->
            <div class="d-flex ms-lg-4">
                <a href="{{ route('login.view') }}" class="btn btn-primary btn-sm px-4">
                    <i class="fas fa-user-circle me-2"></i> Panel
                </a>
            </div>
        </div>
    </div>
</header>
