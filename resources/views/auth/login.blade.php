<x-guest-layout>
    <x-auth-card :title="__('Welcome Back')" :subtitle="__('Login to access your dashboard')">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form x-data="{ loading: false }" method="POST" action="{{ route('login') }}" class="space-y-6" @submit="loading = true">
            @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-jordy-blue-700" />
            <x-input-with-icon id="email" icon="fas fa-envelope" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-jordy-blue-700" />

            <x-input-with-icon id="password" icon="fas fa-lock" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-jordy-blue-300 text-jordy-blue-600 shadow-sm focus:ring-jordy-blue-400" name="remember">
                <span class="ms-2 text-sm text-jordy-blue-600">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-jordy-blue-600 hover:text-jordy-blue-800 hover:underline transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-jordy-blue-400 focus:ring-offset-2 rounded-md" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-loading-button class="w-full justify-center" x-bind:loading="loading">
                {{ __('Log in') }}
            </x-loading-button>
        </div>
        
        @if (Route::has('register'))
            <div class="text-center mt-6 text-sm text-jordy-blue-600">
                {{ __('Don\'t have an account?') }}
                <a href="{{ route('register') }}" class="text-jordy-blue-700 hover:text-jordy-blue-800 hover:underline font-medium">{{ __('Register') }}</a>
            </div>
        @endif
        </form>
    </x-auth-card>
</x-guest-layout>
