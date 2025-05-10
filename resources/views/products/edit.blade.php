@extends('master')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Éditer ce produit</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5 class="alert-heading">Des erreurs ont été détectées :</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm bg-white">
        @csrf 
        @method("PUT")

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Titre du produit">
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">Prix</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Prix du produit">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description du produit">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select name="category_id" class="form-select" id="category_id">
                <option value="">Sélectionner une catégorie</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('category_id', $product->category_id) == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->category_name }}
                    </option>                    
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="subcategory_id" class="form-label">Sous Catégorie</label>
            <select name="subcategory_id" class="form-select" id="subcategory_id" required>
                <option value="">Sélectionner une sous catégorie</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                        {{ $subcategory->subcategory_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantité</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" placeholder="Quantité disponible">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
            @if($product->image)
                <img id="imagePreview" src="{{ asset('storage/' . $product->image) }}" alt="Image actuelle" class="img-thumbnail mt-3" style="max-height: 200px;">
            @else
                <img id="imagePreview" src="#" alt="Prévisualisation" class="img-fluid mt-3 d-none" style="max-height: 200px;">
            @endif
        </div>
        <div class="mb-3">
            <label for="image2" class="form-label">Image 2</label>
            <input type="file" class="form-control" id="image2" name="image2" onchange="previewImage(event)">
            @if($product->image2)
                <img id="imagePreview" src="{{ asset('storage/' . $product->image2) }}" alt="Image actuelle" class="img-thumbnail mt-3" style="max-height: 200px;">
            @else
                <img id="imagePreview" src="#" alt="Prévisualisation" class="img-fluid mt-3 d-none" style="max-height: 200px;">
            @endif
        </div> <div class="mb-3">
            <label for="image3" class="form-label">Image 3</label>
            <input type="file" class="form-control" id="image3" name="image3" onchange="previewImage(event)">
            @if($product->image3)
                <img id="imagePreview" src="{{ asset('storage/' . $product->image3) }}" alt="Image actuelle" class="img-thumbnail mt-3" style="max-height: 200px;">
            @else
                <img id="imagePreview" src="#" alt="Prévisualisation" class="img-fluid mt-3 d-none" style="max-height: 200px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </form>
</div>

<script>
    // Fonction pour prévisualiser l'image avant l'upload
    function previewImage(event) {
        const image = document.getElementById('imagePreview');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.classList.remove('d-none');
    }

    // Charger les sous-catégories en fonction de la catégorie sélectionnée
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategorySelect = document.getElementById('subcategory_id');
        subcategorySelect.innerHTML = '<option value="">Sélectionner une sous catégorie</option>'; // Réinitialiser les sous-catégories

        if (categoryId) {
            // Faire une requête Ajax pour récupérer les sous-catégories
            fetch(`/subcategory/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    // Ajouter les sous-catégories récupérées
                    data.subcategories.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.subcategory_name;
                        subcategorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur:', error));
        }
    });
</script>

@endsection
