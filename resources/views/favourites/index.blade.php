@extends('master')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 class="mb-4"><span class="me-2">❤️</span>Mes produits favoris</h3>

    <div class="row">
        @forelse ($favourites as $favourite)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if ($favourite->product)
                        <img src="{{ asset('storage/' . $favourite->product->image) }}" class="card-img-top rounded-top" alt="Image du produit" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $favourite->product->name }}</h5>
                            <p class="card-text text-muted small">{{ $favourite->product->description }}</p>
                            <p class="card-text fw-bold mb-2">💰 {{ $favourite->product->price }} €</p>
                            <form action="{{ route('favourites.destroy', $favourite->id) }}" method="POST" class="mt-auto">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    ❌ Supprimer du favoris
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="card-body">
                            <p class="text-danger">Produit introuvable.</p>
                        </div>
                    @endif

                    <div class="card-footer bg-light text-muted small">
                        @if ($favourite->user)
                            <span>👤 {{ $favourite->user->name }}</span><br>
                            <span>📧 {{ $favourite->user->email }}</span>
                        @else
                            <span class="text-danger">Utilisateur introuvable</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Aucun produit favori pour le moment.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
