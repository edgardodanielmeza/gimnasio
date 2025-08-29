<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-base-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
            <form>
                <div class="bg-base-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-base-content">{{ $miembro_id ? 'Editar' : 'Crear' }} Miembro</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="nombre" class="label"><span class="label-text">Nombre</span></label>
                            <input type="text" id="nombre" wire:model.lazy="nombre" class="input input-bordered w-full">
                            @error('nombre') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="apellido" class="label"><span class="label-text">Apellido</span></label>
                            <input type="text" id="apellido" wire:model.lazy="apellido" class="input input-bordered w-full">
                            @error('apellido') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="documento_identidad" class="label"><span class="label-text">Documento de Identidad</span></label>
                            <input type="text" id="documento_identidad" wire:model.lazy="documento_identidad" class="input input-bordered w-full">
                            @error('documento_identidad') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="email" class="label"><span class="label-text">Email</span></label>
                            <input type="email" id="email" wire:model.lazy="email" class="input input-bordered w-full">
                            @error('email') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="telefono" class="label"><span class="label-text">Teléfono</span></label>
                            <input type="text" id="telefono" wire:model.lazy="telefono" class="input input-bordered w-full">
                            @error('telefono') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="fecha_nacimiento" class="label"><span class="label-text">Fecha de Nacimiento</span></label>
                            <input type="date" id="fecha_nacimiento" wire:model.lazy="fecha_nacimiento" class="input input-bordered w-full">
                            @error('fecha_nacimiento') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="sucursal_registro_id" class="label"><span class="label-text">Sucursal de Registro</span></label>
                            <select id="sucursal_registro_id" wire:model="sucursal_registro_id" class="select select-bordered w-full">
                                <option value="">Seleccione una sucursal</option>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                            @error('sucursal_registro_id') <span class="text-error">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="photo" class="label"><span class="label-text">Foto</span></label>
                            <input type="file" id="photo" wire:model="photo" class="file-input file-input-bordered w-full">
                            @error('photo') <span class="text-error">{{ $message }}</span>@enderror

                            <div wire:loading wire:target="photo" class="text-sm text-gray-500 mt-2">Cargando...</div>

                            @if ($photo)
                                <div class="mt-2">
                                    <p>Previsualización:</p>
                                    <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 object-cover rounded">
                                </div>
                            @elseif ($existing_photo)
                                <div class="mt-2">
                                    <p>Foto Actual:</p>
                                    <img src="{{ asset('storage/' . $existing_photo) }}" class="w-24 h-24 object-cover rounded">
                                </div>
                            @endif
                        </div>
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
