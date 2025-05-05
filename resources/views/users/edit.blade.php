@extends('master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">modifier  utilisateur</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>Erreurs de validation :</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update',$user->id) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom" value="{{ old('name',$user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'adresse e-mail" value="{{ old('email',$user->email) }}" required>
                </div>
               
                <button type="submit" class="btn btn-success">modifier l'utilisateur</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Annuler</a>
            </form>
        </div>
    </div>
</div>
@endsection
