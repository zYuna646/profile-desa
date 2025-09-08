<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-jordy-blue-800 mb-2">{{ __('Reset Password') }}</h1>
    </div>
    
    <div class="mb-6 text-sm text-jordy-blue-700 bg-jordy-blue-50 p-4 rounded-md border border-jordy-blue-200">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        
        <div class="text-center mt-6 text-sm text-jordy-blue-600">
            <a href="{{ route('login') }}" class="text-jordy-blue-700 hover:text-jordy-blue-800 hover:underline font-medium transition-all duration-300">
                {{ __('Back to login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
