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

                @session('status')
                    <div class="mb-4 font-medium text-sm text-success">
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label class="label" for="email">
                            <span class="label-text">{{ __('Email') }}</span>
                        </label>
                        <input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <label class="label" for="password">
                            <span class="label-text">{{ __('Password') }}</span>
                        </label>
                        <input id="password" class="input input-bordered w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm hover:text-primary" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button class="btn btn-primary ms-4">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
