@extends('master')
@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Messages reçus</h1>

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

    @foreach ($messages as $message)
    <div class="card mb-4 p-3 shadow-sm">
        <h5><strong>Nom :</strong> {{ $message->user->name }}</h5>
        <p><strong>Email :</strong> {{ $message->user->email }}</p>
        <p><strong>Message :</strong><br>{{ $message->message }}</p>

        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary mb-2"
           onclick="document.getElementById('reply-form-{{ $message->id }}').classList.toggle('d-none')">
            Répondre
        </a>

        <form id="reply-form-{{ $message->id }}" class="d-none" action="{{ route('contact.reply') }}" method="POST">
            @csrf
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <input type="hidden" name="user_email" value="{{ $message->user->email }}">

            <div class="mb-2">
                <textarea name="reply" class="form-control @error('reply') is-invalid @enderror"
                          rows="3" placeholder="Écrivez votre réponse ici...">{{ old('reply') }}</textarea>
                @error('reply')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success btn-sm">Envoyer la réponse</button>
        </form>
    </div>
    @endforeach
</div>

@endsection
