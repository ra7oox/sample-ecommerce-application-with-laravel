@extends('master')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <h2 class="mb-4 text-primary">Détail du produit</h2>

    <div class="card shadow-sm mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-start" alt="Image du produit">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title text-dark">{{ $product->name }}</h3>
                    <p class="mb-2">
                        <strong>Catégorie:</strong>
                        <a href="{{ route('categories.show', $product->category->id) }}" class="btn btn-sm btn-outline-success">
                            {{ $product->category->category_name }}
                        </a>
                    </p>
                    <p class="mb-2"><strong>Sous-catégorie:</strong> {{ $product->subcategory->subcategory_name }}</p>
                    <p><strong>Description :</strong> {{ $product->description }}</p>
                    <p><strong>Quantité :</strong> {{ $product->quantity }}</p>
                    <p><strong>Prix :</strong> {{ number_format($product->price, 2) }} €</p>
                    <p><strong>Vendeur :</strong> {{ $product->user->name ?? "Inconnu" }}</p>

                    <div class="mt-3 d-flex gap-2">
                        @can('update-product', $product)
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        @endcan

                        @can('delete-product')
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        @endcan

                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   {{-- SECTION AVIS PRODUIT --}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="card-title text-secondary mb-3">Les Avis sur ce produit</h4>

        @forelse ($reviews as $review)
            <div class="mb-3 p-3 border rounded bg-light position-relative">
                <h6 class="mb-1"><strong>{{ $review->client->name }}</strong> a écrit :</h6>

                {{-- Contenu initial --}}
                <p class="mb-2" id="review-text-{{ $review->id }}">{{ $review->review }}</p>

                {{-- Formulaire caché --}}
                @can('update-review', $review)
                    <form action="{{ route('reviews.update', $review->id) }}" method="POST" id="edit-form-{{ $review->id }}" style="display: none;">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <textarea name="review" class="form-control" rows="2" required>{{ $review->review }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEditForm({{ $review->id }})">Annuler</button>
                    </form>

                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-outline-primary" onclick="toggleEditForm({{ $review->id }})">Modifier l’avis</button>

                    </div>
                @endcan

                @can('delete', $review)
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="text-end mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                @endcan
            </div>
        @empty
            <p>Aucun avis pour ce produit.</p>
        @endforelse
    </div>
</div>

    

    @can("create-review")

    {{-- SECTION AVIS --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title text-secondary mb-3">Ajouter un avis</h4>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="client_id" value="{{ Auth::id() }}">

                <div class="mb-3">
                    <label for="review" class="form-label">Votre avis</label>
                    <textarea name="review" id="review" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
    </div>
    @endcan
</div>

<script>
    function toggleEditForm(reviewId) {
        const form = document.getElementById(`edit-form-${reviewId}`);
        const text = document.getElementById(`review-text-${reviewId}`);

        if (form.style.display === "none") {
            form.style.display = "block";
            text.style.display = "none";
        } else {
            form.style.display = "none";
            text.style.display = "block";
        }
    }
</script>

@endsection
