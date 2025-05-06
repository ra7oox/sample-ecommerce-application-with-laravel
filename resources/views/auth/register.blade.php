<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-white mb-6">
            {{ __('Create an Account') }}
        </h2>
        @if ($errors->any())
        <div class="mb-4">
            <div class="text-red-600 font-medium">
                {{ __('Oops! Il y a des erreurs dans le formulaire :') }}
            </div>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Account Type -->
            <div class="mt-4">
                <x-input-label for="account_type" :value="__('Account Type')" />
                <select name="account_type" id="account_type"
                    class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">{{ __('Select account type') }}</option>
                    <option value="client" {{ old('account_type') == 'client' ? 'selected' : '' }}>{{ __('Client') }}</option>
                    <option value="seller" {{ old('account_type') == 'seller' ? 'selected' : '' }}>{{ __('Seller') }}</option>
                </select>
                <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
