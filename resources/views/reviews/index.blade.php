@extends('master')
@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-primary">Liste des avis sur mes produits</h2>

    @forelse ($reviews as $review)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="bi bi-person-circle text-secondary me-2"></i>
                    {{ $review->client->name ?? 'Client inconnu' }}
                </h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <i class="bi bi-box-seam me-1"></i>
                    Produit : <span class="fw-semibold">{{ $review->product->name }}</span>
                </h6>
                <p class="card-text mt-3">
                    <i class="bi bi-chat-left-quote text-success me-2"></i>
                    {{ $review->review }}
                </p>

                <div class="text-end">
                    <a href="{{ route('products.show', $review->product->id) }}" class="btn btn-sm btn-outline-primary">
                        Voir le produit
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Aucun avis trouvé pour vos produits.
        </div>
    @endforelse
</div>

@endsection
