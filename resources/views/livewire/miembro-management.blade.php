<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Gestión de Miembros') }}
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

                    <div class="flex justify-between mb-4">
                        <button wire:click="create()" class="btn btn-primary">Crear Nuevo Miembro</button>
                        <input type="text" wire:model.lazy="search" placeholder="Buscar miembros..." class="input input-bordered w-full max-w-xs">
                    </div>

                    @if($isOpen)
                        @include('livewire.miembro-management-modal')
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($miembros as $miembro)
                                <tr>
                                    <td>{{ $miembro->id }}</td>
                                    <td>{{ $miembro->nombre }} {{ $miembro->apellido }}</td>
                                    <td>{{ $miembro->documento_identidad }}</td>
                                    <td>{{ $miembro->email }}</td>
                                    <td>{{ $miembro->telefono }}</td>
                                    <td class="flex gap-2">
                                        <a href="{{ route('miembros.show', $miembro) }}" class="btn btn-sm btn-info">Ver Detalles</a>
                                        <button wire:click="edit({{ $miembro->id }})" class="btn btn-sm btn-warning">Editar Rápido</button>
                                        <button wire:click="delete({{ $miembro->id }})" class="btn btn-sm btn-error">Eliminar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $miembros->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
