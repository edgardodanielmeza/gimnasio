<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Gestión de Tipos de Membresía') }}
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

                    <button wire:click="create()" class="btn btn-primary mb-4">Crear Nuevo Tipo de Membresía</button>

                    @if($isOpen)
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block align-bottom bg-base-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
                                    <form>
                                        <div class="bg-base-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                            <h3 class="text-lg font-medium leading-6 text-base-content">{{ $tipo_membresia_id ? 'Editar' : 'Crear' }} Tipo de Membresía</h3>
                                            <div class="mt-4">
                                                <label for="nombre" class="label"><span class="label-text">Nombre</span></label>
                                                <input type="text" id="nombre" wire:model.lazy="nombre" class="input input-bordered w-full">
                                                @error('nombre') <span class="text-error">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mt-4">
                                                <label for="descripcion" class="label"><span class="label-text">Descripción</span></label>
                                                <textarea id="descripcion" wire:model.lazy="descripcion" class="textarea textarea-bordered w-full"></textarea>
                                                @error('descripcion') <span class="text-error">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mt-4">
                                                <label for="precio" class="label"><span class="label-text">Precio</span></label>
                                                <input type="number" id="precio" wire:model.lazy="precio" class="input input-bordered w-full">
                                                @error('precio') <span class="text-error">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mt-4">
                                                <label for="duracion_dias" class="label"><span class="label-text">Duración (días)</span></label>
                                                <input type="number" id="duracion_dias" wire:model.lazy="duracion_dias" class="input input-bordered w-full">
                                                @error('duracion_dias') <span class="text-error">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="bg-base-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <button wire:click.prevent="store()" type="button" class="btn btn-primary">Guardar</button>
                                            <button wire:click="closeModal()" type="button" class="btn btn-ghost">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Duración (días)</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tiposMembresia as $tipo)
                                <tr>
                                    <td>{{ $tipo->id }}</td>
                                    <td>{{ $tipo->nombre }}</td>
                                    <td>{{ $tipo->precio }}</td>
                                    <td>{{ $tipo->duracion_dias }}</td>
                                    <td>
                                        <button wire:click="edit({{ $tipo->id }})" class="btn btn-sm btn-warning">Editar</button>
                                        <button wire:click="delete({{ $tipo->id }})" class="btn btn-sm btn-error">Eliminar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $tiposMembresia->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
