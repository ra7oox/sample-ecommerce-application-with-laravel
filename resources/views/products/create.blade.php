@extends('master')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Ajouter un produit</h3>
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Il y a des erreurs dans votre formulaire :</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-light">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Titre du produit" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description du produit" value="{{ old('description') }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select name="category_id" class="form-select" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('category_id') == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantité du produit" value="{{ old('quantity') }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)" value="{{ old('image') }}">
            <img id="imagePreview" src="#" alt="Prévisualisation" class="img-fluid mt-3 d-none" style="max-height: 200px;">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Prix du produit" value="{{ old('price') }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
    </form>
</div>

{{-- Script pour prévisualiser l'image --}}
<script>
    function previewImage(event) {
        const image = document.getElementById('imagePreview');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.classList.remove('d-none');
    }
</script>

@endsection
