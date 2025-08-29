<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Configuración del Sistema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    @if (session()->has('message'))
                        <div role="alert" class="alert alert-success mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('message') }}</span>
                        </div>
                    @endif

                    <form wire:submit.prevent="update">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- App Name -->
                            <div class="form-control">
                                <label for="app_name" class="label"><span class="label-text">Nombre de la Aplicación</span></label>
                                <input type="text" id="app_name" wire:model.lazy="app_name" class="input input-bordered w-full">
                                @error('app_name') <span class="text-error">{{ $message }}</span>@enderror
                            </div>

                            <!-- App Currency -->
                            <div class="form-control">
                                <label for="app_currency" class="label"><span class="label-text">Símbolo de Moneda</span></label>
                                <input type="text" id="app_currency" wire:model.lazy="app_currency" class="input input-bordered w-full">
                                @error('app_currency') <span class="text-error">{{ $message }}</span>@enderror
                            </div>

                            <!-- Light Theme -->
                            <div class="form-control">
                                <label for="theme_light" class="label"><span class="label-text">Tema para Modo Claro</span></label>
                                <select id="theme_light" wire:model="theme_light" class="select select-bordered w-full">
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme }}">{{ ucfirst($theme) }}</option>
                                    @endforeach
                                </select>
                                @error('theme_light') <span class="text-error">{{ $message }}</span>@enderror
                            </div>

                            <!-- Dark Theme -->
                            <div class="form-control">
                                <label for="theme_dark" class="label"><span class="label-text">Tema para Modo Oscuro</span></label>
                                <select id="theme_dark" wire:model="theme_dark" class="select select-bordered w-full">
                                    @foreach($themes as $theme)
                                        <option value="{{ $theme }}">{{ ucfirst($theme) }}</option>
                                    @endforeach
                                </select>
                                @error('theme_dark') <span class="text-error">{{ $message }}</span>@enderror
                            </div>

                            <!-- App Logo -->
                            <div class="form-control">
                                <label for="new_logo" class="label"><span class="label-text">Logo de la Aplicación</span></label>
                                <input type="file" id="new_logo" wire:model="new_logo" class="file-input file-input-bordered w-full">
                                @error('new_logo') <span class="text-error">{{ $message }}</span>@enderror

                                <div wire:loading wire:target="new_logo" class="text-sm mt-2">Cargando...</div>

                                @if ($new_logo)
                                    <div class="mt-2">
                                        <p>Previsualización Nuevo Logo:</p>
                                        <img src="{{ $new_logo->temporaryUrl() }}" class="w-32 h-32 object-contain p-2 border rounded">
                                    </div>
                                @elseif ($app_logo)
                                    <div class="mt-2">
                                        <p>Logo Actual:</p>
                                        <img src="{{ asset('storage/' . $app_logo) }}" class="w-32 h-32 object-contain p-2 border rounded">
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="mt-6 text-right">
                            <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
