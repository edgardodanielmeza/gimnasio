<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="card w-full sm:max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-center mb-4">
                    <a href="/">
                        <x-authentication-card-logo />
                    </a>
                </div>

                <div x-data="{ recovery: false }">
                    <div class="mb-4 text-sm" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </div>

                    <div class="mb-4 text-sm" x-cloak x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </div>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="mt-4" x-show="! recovery">
                            <x-label for="code" value="{{ __('Code') }}" />
                            <x-input id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                        </div>

                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                            <x-input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="button" class="text-sm hover:text-primary underline cursor-pointer"
                                            x-show="! recovery"
                                            x-on:click="
                                                recovery = true;
                                                $nextTick(() => { $refs.recovery_code.focus() })
                                            ">
                                {{ __('Use a recovery code') }}
                            </button>

                            <button type="button" class="text-sm hover:text-primary underline cursor-pointer"
                                            x-cloak
                                            x-show="recovery"
                                            x-on:click="
                                                recovery = false;
                                                $nextTick(() => { $refs.code.focus() })
                                            ">
                                {{ __('Use an authentication code') }}
                            </button>

                            <x-button class="ms-4 btn-primary">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
