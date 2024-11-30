<div class="nav flex-column h-100 p-3 position-relative bg-white">
    <nav>
        <a href="{{ route('dashboard') }}" 
           class="nav-link d-flex align-items-center {{ Route::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-3"></i> Dashboard
        </a>
        <a href="{{ route('steps') }}" 
           class="nav-link d-flex align-items-center {{ Route::is('steps') ? 'active' : '' }}">
            <i class="fas fa-shoe-prints me-3"></i> Kroki
        </a>
        <a href="{{ route('coupons') }}" 
           class="nav-link d-flex align-items-center {{ Route::is('coupons') ? 'active' : '' }}">
            <i class="fas fa-ticket-alt me-3"></i> Kupony
        </a>
        <a href="{{ route('transactions') }}" 
           class="nav-link d-flex align-items-center {{ Route::is('transactions') ? 'active' : '' }}">
            <i class="fas fa-wallet me-3"></i> Wpłaty/Wypłaty
        </a>
        <a href="#" 
           class="nav-link d-flex align-items-center ">
            <i class="fas fa-user me-3"></i> Profil
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" 
           class="nav-link d-flex align-items-center logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-3"></i> Wyloguj się
        </a>
    </nav>
</div>
