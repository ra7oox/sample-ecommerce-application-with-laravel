@extends('master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Contacter l'admin</h1>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="account_type" value="{{ Auth::user()->account_type }}">

        <div class="mb-3">
            <label class="form-label">Type de compte</label>
            <input type="text" class="form-control" value="{{ Auth::user()->account_type }}" readonly>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control" rows="5" placeholder="Écrivez votre message...">{{ old('message') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
