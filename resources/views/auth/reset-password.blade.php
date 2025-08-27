<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="card w-full sm:max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-center mb-4">
                    <a href="/">
                        <x-authentication-card-logo />
                    </a>
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="block">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="btn-primary">
                            {{ __('Reset Password') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
