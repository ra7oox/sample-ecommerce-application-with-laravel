@extends('master')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">✏️ Modifier la Catégorie</h2>

    {{-- Affichage des erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf
        @method("PUT")

        <div class="mb-3">
            <label for="category_image" class="form-label">Image de la catégorie</label>
            <input type="file" name="category_image" class="form-control" id="category_image">
            <img id="preview-image" src="{{ asset('storage/' . $category->category_image) }}" 
                 alt="Aperçu" class="mt-3 img-thumbnail" style="max-height: 200px;">
        </div>

        <div class="mb-3">
            <label for="category_name" class="form-label">Nom de la catégorie</label>
            <input type="text" name="category_name" id="category_name" class="form-control"
                   placeholder="Entrez le nom de la catégorie" value="{{ old('category_name', $category->category_name) }}">
        </div>

        <button type="submit" class="btn btn-primary">
            💾 Mettre à jour
        </button>
    </form>
</div>

{{-- JS pour l’aperçu de l’image --}}
<script>
    document.getElementById('category_image').addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById('preview-image').src = event.target.result;
        }
        if (e.target.files[0]) {
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
