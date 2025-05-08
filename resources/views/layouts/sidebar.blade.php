<div class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-md">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-indigo-600 dark:text-white">Shopily</h1>
        </div>
        <nav class="mt-6">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        🏠 Tableau de bord
                    </a>
                </li>
                @can('show-user')
                    
               
                <li>
                    <a href="{{ route('users.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        👥 Utilisateurs
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        🛍 Produits
                    </a>
                </li>
                @can('show-favourites')
                    
                
                <li>
                    <a href="{{ route('favourites.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        ❤️ Produits favoris
                    </a>
                </li>
                @endcan
                
                <li>
                    <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        📦 Commandes
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        📂 Catégories
                    </a>
                </li>
                <li>
                    <a href="{{ route('subcategories.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                        🧾 Sous Catégories
                    </a>
                </li>
                
                @if (Auth::user())
                    
               
                @if(auth()->user()->account_type === 'admin')
                    <li>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-indigo-700 rounded">
                            ✅ Demandes de compte
                        </a>
                    </li>
                @endif
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900 rounded">
                            🚪 Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
    </main>
</div>
