<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-madang-800 mb-2">{{ __('Welcome Back') }}</h1>
        <p class="text-madang-600">{{ __('Login to access your dashboard') }}</p>
    </div>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-madang-700" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-madang-700" />

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-madang-300 text-madang-600 shadow-sm focus:ring-madang-500" name="remember">
                <span class="ms-2 text-sm text-madang-600">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-madang-600 hover:text-madang-800 hover:underline transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-madang-500 focus:ring-offset-2 rounded-md" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        
        @if (Route::has('register'))
            <div class="text-center mt-6 text-sm text-madang-600">
                {{ __('Don\'t have an account?') }}
                <a href="{{ route('register') }}" class="text-madang-700 hover:text-madang-800 hover:underline font-medium">{{ __('Register') }}</a>
            </div>
        @endif
    </form>
</x-guest-layout>
