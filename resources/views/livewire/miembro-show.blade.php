<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            Detalles del Miembro: {{ $miembro->nombre }} {{ $miembro->apellido }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('message'))
                <div role="alert" class="alert alert-success mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('message') }}</span>
                </div>
            @endif

            <!-- Detalles del Miembro -->
            <div class="card bg-base-100 shadow-xl mb-6">
                <div class="card-body">
                    <h2 class="card-title">Información Personal</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <p><strong>Nombre:</strong> {{ $miembro->nombre }} {{ $miembro->apellido }}</p>
                        <p><strong>Documento:</strong> {{ $miembro->documento_identidad }}</p>
                        <p><strong>Email:</strong> {{ $miembro->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $miembro->telefono }}</p>
                    </div>
                </div>
            </div>

            <!-- Sección de Membresías -->
            <div class="card bg-base-100 shadow-xl mb-6">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <h2 class="card-title">Membresías</h2>
                        <button wire:click="openMembresiaModal" class="btn btn-primary">Añadir Membresía</button>
                    </div>
                    <div class="overflow-x-auto mt-4">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($miembro->membresias as $membresia)
                                    <tr>
                                        <td>{{ $membresia->tipoMembresia->nombre }}</td>
                                        <td>{{ $membresia->fecha_inicio }}</td>
                                        <td>{{ $membresia->fecha_fin }}</td>
                                        <td><span class="badge badge-{{ $membresia->estado == 'activa' ? 'success' : 'error' }}">{{ $membresia->estado }}</span></td>
                                        <td>
                                            <button wire:click="openPagoModal({{ $membresia->id }})" class="btn btn-sm btn-secondary">Registrar Pago</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No hay membresías registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sección de Pagos -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Historial de Pagos</h2>
                    <div class="overflow-x-auto mt-4">
                         <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Método</th>
                                    <th>Membresía</th>
                                    <th>Registrado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($miembro->membresias->flatMap->pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>{{ $pago->monto }}</td>
                                        <td>{{ $pago->metodo_pago }}</td>
                                        <td>{{ $pago->membresia->tipoMembresia->nombre }} ({{$pago->membresia->fecha_inicio}})</td>
                                        <td>{{ $pago->receptor->name }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center">No hay pagos registrados.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if($showMembresiaModal)
        @include('livewire.miembro-show-membresia-modal')
    @endif

    @if($showPagoModal)
        @include('livewire.miembro-show-pago-modal')
    @endif
</div>
