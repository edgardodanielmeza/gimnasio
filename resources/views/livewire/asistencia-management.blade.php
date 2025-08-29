<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Control de Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">

                    <!-- Search Form -->
                    <form wire:submit.prevent="searchMiembro" class="flex items-center gap-4">
                        <input type="text" wire:model.defer="search" class="input input-bordered w-full" placeholder="Ingrese Documento de Identidad del Miembro...">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>

                    <!-- Message Area -->
                    @if($message)
                        <div role="alert" class="alert alert-{{ $messageType }} mt-4">
                            <span>{{ $message }}</span>
                        </div>
                    @endif

                    <!-- Member Details & Actions -->
                    @if($miembro)
                        <div class="mt-6 p-4 border rounded-lg bg-base-200">
                            <h3 class="text-2xl font-bold">{{ $miembro->nombre }} {{ $miembro->apellido }}</h3>
                            <p>Documento: {{ $miembro->documento_identidad }}</p>

                            @if($activeMembresia)
                                <div class="mt-2 text-success font-semibold">
                                    Membresía Activa (Vence: {{ \Carbon\Carbon::parse($activeMembresia->fecha_fin)->format('d/m/Y') }})
                                </div>
                                <div class="mt-4 flex gap-4">
                                    <button wire:click="checkIn" class="btn btn-success">Registrar Ingreso</button>
                                    <button wire:click="checkOut" class="btn btn-warning">Registrar Salida</button>
                                </div>
                            @else
                                <div class="mt-2 text-error font-semibold">
                                    Sin membresía activa.
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
