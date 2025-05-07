@extends('master')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <h6>Des erreurs sont survenues :</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Modifier la sous-catégorie</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label">Nom de la catégorie</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subcategory_name" class="form-label">Nom de la sous-catégorie</label>
                    <input type="text" name="subcategory_name" id="subcategory_name" class="form-control"
                        value="{{ old('subcategory_name', $subcategory->subcategory_name) }}">
                    @error('subcategory_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Modifier</button>
            </form>
        </div>
    </div>
</div>
@endsection
