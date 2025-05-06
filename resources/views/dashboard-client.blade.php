@extends('master')

@section('content')
<div class="container mt-5">
    <div class="p-5 bg-white rounded shadow text-center">
        <h1 class="text-success fw-bold mb-3">Bienvenue sur votre espace client</h1>
        <p class="fs-5 text-muted">Consultez vos produits préférés, suivez vos commandes et explorez nos nouveautés.</p>
    </div>

    <div class="row text-center mt-5 g-4">
        @php
            $cards = [
                [
                    'icon' => '🆕',
                    'title' => 'Derniers produits',
                    'text' => 'Découvrez les nouveautés récemment ajoutées.',
                    'route' => route('last-products'),
                    'btn_class' => 'btn-outline-primary',
                    'btn_text' => 'Voir'
                ],
                [
                    'icon' => '📦',
                    'title' => 'Tous les produits',
                    'text' => 'Parcourez l\'ensemble de notre catalogue.',
                    'route' => route('products.index'),
                    'btn_class' => 'btn-outline-success',
                    'btn_text' => 'Explorer'
                ],
                [
                    'icon' => '👤',
                    'title' => 'Mon profil',
                    'text' => 'Consultez ou modifiez vos informations personnelles.',
                    'route' => route('profile.edit'),
                    'btn_class' => 'btn-outline-secondary',
                    'btn_text' => 'Profil'
                ],
                [
                    'icon' => '🧾',
                    'title' => 'Mes commandes',
                    'text' => 'Suivez l’état de vos commandes.',
                    'route' => route('orders.index'),
                    'btn_class' => 'btn-outline-dark',
                    'btn_text' => 'Commandes'
                ],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2 fs-1">{{ $card['icon'] }}</div>
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <p class="text-muted">{{ $card['text'] }}</p>
                        <a href="{{ $card['route'] }}" class="btn {{ $card['btn_class'] }} mt-auto w-100">
                            {{ $card['btn_text'] }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
