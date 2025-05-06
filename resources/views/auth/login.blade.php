<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <!-- Session Status -->
        @if (session('success'))
            <div class="mb-4 text-sm font-medium text-green-700 bg-green-100 border border-green-300 rounded-lg p-4 dark:bg-green-800 dark:text-green-100 dark:border-green-700">
                {{ session('success') }}
            </div>
        @endif
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Connexion à votre compte</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Adresse e-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-500" name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600 dark:text-gray-300">
                    {{ __('Se souvenir de moi') }}
                </label>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-6">
                <div class="mb-2 sm:mb-0">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </div>
                <div class="mb-2 sm:mb-0">
                    <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400" href="{{ route('register') }}">
                        {{ __("Vous n'avez pas de compte ?") }}
                    </a>
                </div>
                <x-primary-button class="w-full sm:w-auto mt-3 sm:mt-0">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
