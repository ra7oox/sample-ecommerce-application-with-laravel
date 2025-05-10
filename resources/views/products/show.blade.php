@extends('master')

@section('content')
<div class="container mt-5">

    {{-- Messages d'erreur ou de succès --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4 text-primary">Détail du produit</h2>

    <div class="card shadow-sm mb-5 p-3">
        <div class="row">
            <div class="col-md-6">

                

                {{-- Image principale --}}
                <div class="text-center">
                    <img id="mainImage" src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow" style="max-height: 400px;" alt="Image principale">
                </div>
                {{-- Vignettes au-dessus --}}
                <div class="d-flex gap-2 mb-3 justify-content-center">
                    @foreach ([$product->image, $product->image2, $product->image3] as $img)
                        @if ($img)
                            <img src="{{ asset('storage/' . $img) }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                onclick="changeMainImage('{{ asset('storage/' . $img) }}')">
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title">{{ $product->name }}</h3>
                    <p><strong>Catégorie:</strong>
                        <a href="{{ route('categories.show', $product->category->id) }}" class="btn btn-sm btn-outline-success">
                            {{ $product->category->category_name }}
                        </a>
                    </p>
                    <p><strong>Sous-catégorie:</strong> {{ $product->subcategory->subcategory_name }}</p>
                    <p><strong>Description :</strong> {{ $product->description }}</p>
                    <p><strong>Quantité :</strong> {{ $product->quantity }}</p>
                    <p><strong>Prix :</strong> {{ number_format($product->price, 2) }} €</p>
                    <p><strong>Vendeur :</strong> {{ $product->user->name ?? 'Inconnu' }}</p>

                    {{-- Boutons --}}
                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Retour</a>

                        @can('update-product', $product)
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        @endcan

                        @can('delete-product', $product)
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section des avis --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title text-secondary mb-3">Avis des clients</h4>

            @forelse ($reviews as $review)
                <div class="mb-3 p-3 border rounded bg-light">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $review->client->name }}</strong>
                        <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                    </div>
                    <p id="review-text-{{ $review->id }}">{{ $review->review }}</p>

                    {{-- Formulaire de modification --}}
                    @can('update-review', $review)
                        <form action="{{ route('reviews.update', $review->id) }}" method="POST" id="edit-form-{{ $review->id }}" style="display: none;">
                            @csrf
                            @method('PUT')
                            <textarea name="review" class="form-control mb-2" rows="2" required>{{ $review->review }}</textarea>
                            <button type="submit" class="btn btn-sm btn-success">Enregistrer</button>
                            <button type="button" class="btn btn-sm btn-secondary" onclick="toggleEditForm({{ $review->id }})">Annuler</button>
                        </form>

                        <button class="btn btn-sm btn-outline-primary mt-2" onclick="toggleEditForm({{ $review->id }})">Modifier</button>
                    @endcan

                    {{-- Suppression --}}
                    @can('delete', $review)
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline-block mt-2 float-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet avis ?')">Supprimer</button>
                        </form>
                    @endcan
                </div>
            @empty
                <p class="text-muted">Aucun avis pour ce produit.</p>
            @endforelse
        </div>
    </div>

    {{-- Ajouter un avis --}}
    @can('create-review')
        <div class="card shadow-sm mb-5">
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
    function toggleEditForm(id) {
        const form = document.getElementById(`edit-form-${id}`);
        const text = document.getElementById(`review-text-${id}`);
        if (form.style.display === 'none') {
            form.style.display = 'block';
            text.style.display = 'none';
        } else {
            form.style.display = 'none';
            text.style.display = 'block';
        }
    }
</script>
{{-- Script JS --}}
<script>
    function changeMainImage(src) {
        document.getElementById('mainImage').src = src;
    }
</script>
@endsection
