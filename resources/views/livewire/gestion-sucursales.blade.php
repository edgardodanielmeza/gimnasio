<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Sucursales
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session()->has('message'))
                    <div class="alert alert-success shadow-lg mb-4">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>{{ session('message') }}</span>
                        </div>
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <div class="form-control">
                        <input wire:model.live.debounce.300ms="searchTerm" type="text" placeholder="Buscar sucursal..." class="input input-bordered w-full max-w-xs" />
                    </div>
                    <button wire:click="create()" class="btn btn-primary">
                        Crear Sucursal
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sucursales as $sucursal)
                            <tr>
                                <td>{{ $sucursal->nombre }}</td>
                                <td>{{ $sucursal->direccion }}</td>
                                <td>{{ $sucursal->telefono }}</td>
                                <td class="text-right">
                                    <button wire:click="edit({{ $sucursal->id }})" class="btn btn-sm btn-warning">Editar</button>
                                    <button wire:click="delete({{ $sucursal->id }})" onclick="confirm('¿Estás seguro de que quieres eliminar esta sucursal?') || event.stopImmediatePropagation()" class="btn btn-sm btn-error">Eliminar</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No se encontraron sucursales.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $sucursales->links() }}
                </div>

                @if($isOpen)
                <div class="modal modal-open">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">{{ $sucursal_id ? 'Editar' : 'Crear' }} Sucursal</h3>
                        <form wire:submit.prevent="store">
                            <div class="form-control w-full mt-4">
                                <label class="label"><span class="label-text">Nombre</span></label>
                                <input type="text" wire:model.defer="nombre" placeholder="Nombre de la sucursal" class="input input-bordered w-full" />
                                @error('nombre') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-control w-full mt-4">
                                <label class="label"><span class="label-text">Dirección</span></label>
                                <input type="text" wire:model.defer="direccion" placeholder="Dirección de la sucursal" class="input input-bordered w-full" />
                                @error('direccion') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-control w-full mt-4">
                                <label class="label"><span class="label-text">Teléfono</span></label>
                                <input type="text" wire:model.defer="telefono" placeholder="Teléfono de la sucursal" class="input input-bordered w-full" />
                                @error('telefono') <span class="text-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="modal-action">
                                <button type="button" wire:click="closeModal()" class="btn">Cancelar</button>
                                <button type="submit" class="btn btn-primary">{{ $sucursal_id ? 'Actualizar' : 'Guardar' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
