<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase" href="{{route("dashboard")}}">Shopily</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch"
            aria-controls="navbarSearch" aria-expanded="false" aria-label="Basculer la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSearch">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold' : '' }}" href="{{ route('dashboard') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('last-products') ? 'active fw-semibold' : '' }}" href="{{ route('last-products') }}">Derniers produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.index') ? 'active fw-semibold' : '' }}" href="{{ route('products.index') }}">Tous les produits</a>
                </li>
            </ul>

            <form class="d-flex me-3" role="search" action="{{ route('products.search') }}" method="POST">
                @csrf
                <input class="form-control me-2 rounded-1" type="search" name="search" placeholder="Rechercher" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Déconnexion</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
