<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="card w-full sm:max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-center mb-4">
                    <a href="/">
                        <x-authentication-card-logo />
                    </a>
                </div>

                <div class="mb-4 text-sm">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                @session('status')
                    <div class="mb-4 font-medium text-sm text-success">
                        {{ $value }}
                    </div>
                @endsession

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="btn-primary">
                            {{ __('Email Password Reset Link') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
