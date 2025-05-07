@extends('master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ajouter une nouvelle catégorie</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Nom de la catégorie</label>
                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Entrez le nom de la catégorie">
                    @error('category_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
