@extends('master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Liste des utilisateurs</h1>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Ajouter</a>

    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if ($users->isEmpty())
        <div class="alert alert-info text-center">Aucun utilisateur trouvé.</div>
    @else
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>{{ $user->account_type ?? 'Utilisateur' }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">Voir</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
