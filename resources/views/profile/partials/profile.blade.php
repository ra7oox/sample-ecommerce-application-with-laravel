
<div class="container mt-5">
    <h1 class="mb-4">Information personnelles</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><strong>Nom complet :</strong>{{ Auth::user()->name }}</h5>
            <p class="card-text"><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p class="card-text"><strong>Type de compte :</strong> {{ ucfirst(Auth::user()->account_type) }}</p>
            <p class="card-text"><strong>Date d'inscription :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>

