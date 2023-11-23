<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-blue-500 py-8 px-6 rounded-lg w-full max-w-md">
        @csrf

        <!-- Centrada la imagen -->
        <div class="flex items-center justify-center mb-8">
            <img src="{{ asset('img/logo3.png') }}" alt="Logo" class="w-full object-contain">
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label class="text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label class="text-white" for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-yellow-300 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ml-2 text-sm text-white">{{ __('Recuérdame') }}</span>
            </label>
        </div>

        <!-- Link to Register Page -->
        <div class="mb-4">
            <p class="text-sm text-white">
                {{ __('¿No tienes una cuenta?') }}
                <a class="underline hover:text-yellow-300" href="{{ route('register') }}">
                    {{ __('Regístrate aquí') }}
                </a>
            </p>
        </div>

        <div class="flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-white hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Acceso') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
