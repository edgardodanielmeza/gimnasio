<div class="fixed z-20 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-base-100 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
            <form>
                <div class="bg-base-100 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium leading-6 text-base-content">Añadir Nueva Membresía</h3>
                    <div class="mt-4">
                        <label for="tipo_membresia_id" class="label"><span class="label-text">Tipo de Membresía</span></label>
                        <select id="tipo_membresia_id" wire:model="tipo_membresia_id" class="select select-bordered w-full">
                            <option value="">Seleccione un tipo</option>
                            @foreach($tiposMembresia as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }} ({{ $tipo->duracion_dias }} días)</option>
                            @endforeach
                        </select>
                        @error('tipo_membresia_id') <span class="text-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <label for="fecha_inicio" class="label"><span class="label-text">Fecha de Inicio</span></label>
                        <input type="date" id="fecha_inicio" wire:model.lazy="fecha_inicio" class="input input-bordered w-full">
                        @error('fecha_inicio') <span class="text-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="bg-base-200 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click.prevent="saveMembresia()" type="button" class="btn btn-primary">Guardar Membresía</button>
                    <button wire:click="$set('showMembresiaModal', false)" type="button" class="btn btn-ghost">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
